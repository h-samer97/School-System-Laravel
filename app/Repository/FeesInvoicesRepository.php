<?php



namespace App\Repository;

use App\Models\Fees;
use App\Models\FeesInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentsAccounts;
use DB;
use Exception;
use Nette\Schema\Expect;


class FeesInvoicesRepository implements IFeesInvoices {

    public function index() {

        $Fee_invoices = FeesInvoice::all();
        $Grades = Grade::all();
        return view('feesInvoices.index',compact('Fee_invoices','Grades'));

    }

    public function show($id) {
        $student          = Student::findOrFail($id); # $id => Student_id
        $feesInvoices     = FeesInvoice::where('student_id' ,$id)->get();
        $fees             = Fees::all();
        return view('feesInvoices.add',compact('student','fees', 'feesInvoices'));
    }

    public function store($request) {
            $fees_list = $request->List_Fees;
            
            DB::beginTransaction();
            try {
                foreach($fees_list as $fee) {
                    
                    $Fees = new FeesInvoice();
                    $Fees->invoice_date = date('Y-m-d');
                    $Fees->student_id   = $fee['student_id'];
                    $Fees->grade_id     = $request->Grade_id;
                    $Fees->classroom_id = $request->Classroom_id;
                    $Fees->fee_id       = $fee['fee_id'];
                    $Fees->amount       = $fee['amount'];
                    $Fees->description  = $fee['description'];
                    $Fees->save();

                    $StudentAccount = new StudentsAccounts();
                    $StudentAccount->student_id     = $fee['student_id'];
                    $StudentAccount->grade_id       = $request->Grade_id;
                    $StudentAccount->classroom_id   = $request->Classroom_id;
                    $StudentAccount->Debit          = $fee['amount'];
                    $StudentAccount->credit         = 0.00;
                    $StudentAccount->description    = $fee['description'];
                    $StudentAccount->type           = 'invoice';
                    
                    $StudentAccount->fee_invoice_id = $Fees->id; 
                    
                    $StudentAccount->date           = date('Y-m-d');
                    $StudentAccount->save();
                }

                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Fees_Invoices.index');

            } catch (Exception $error) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $error->getMessage()]);
            }
}

    public function edit($id) {
    
    $fee_invoices = FeesInvoice::with(['student'])->findOrFail($id);

    $fees = Fees::where('classroom_id', $fee_invoices->classroom_id)->get();

    return view('feesInvoices.edit', compact('fee_invoices', 'fees'));
}

    public function update($request) {
       
        DB::beginTransaction();
        try {
            $Fees = FeesInvoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            $StudentAccount = StudentsAccounts::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($request) {
        try {
            $feesInvoice = FeesInvoice::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.delete'));
            return redirect()->route('Fees_Invoices.index');
        } catch(Exception $error) {
            return redirect()->route('Fees_Invoices.index')->withErrors('errors');
        }
    }

}