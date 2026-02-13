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
        $student  = Student::findOrFail($id)->get();
        $fees     = Fees::where('classroom_id', $student->classroom_id);
        return view('feesInvoices.add',compact('student','fees'));
    }

    public function store($request) {
        
        
        # Form Repeater []
        $fees_list = $request->List_Fees;
                
        DB::beginTransaction();

        try {

             foreach($fees_list as $fee) {

                # Invoice Regester

                $Fees = new FeesInvoice();

                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id   = $fee['student_id'];
                $Fees->grade_id     = $request->Grade_id;
                $Fees->classroom_id = $request->Classroom_id;;
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
                $StudentAccount->fee_invoice_id = $fee->id;
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

        $fee_invoices = FeesInvoice::findOrFail($id)->get();
        $fees         = Fees::where('classroom_id', $fee_invoices->classroom_id)->get();
        return view('feesInvoices.edit',compact('fee_invoices','fees'));

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

}