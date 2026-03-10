<?php


namespace App\Repository;

use App\Models\FundAccounts;
use App\Models\ReceiptStudents;
use App\Models\Student;
use App\Models\StudentsAccounts;
use DB;
use Exception;


class ReceiptStudentsRepository implements IReceiptStudents {


    public function index() {
         $receipt_students = ReceiptStudents::all();
        return view('receipt.index',compact('receipt_students'));
    }

    public function show($id) {

        $student = Student::findorfail($id);
        # add => show
        return view('receipt.add',compact('student'));

    }

    public function edit($id) {

         $receipt_student = ReceiptStudents::findorfail($id);
        return view('receipt.edit',compact('receipt_student'));

    }

     public function destroy($request)
    {
        try {
            ReceiptStudents::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('receipt_students.index');
        }

        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            $receipt_students = ReceiptStudents::findorfail($request->id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->amount = $request->Debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            $fund_accounts = FundAccounts::where('receipt_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            $student_account = StudentsAccounts::where('receipt_id',$request->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'receipt';
            $student_account->student_id = $request->student_id;
            $student_account->receipt_id = $receipt_students->id;
            $student_account->Debit = 0.00;
            $student_account->credit = $request->Debit;
            $student_account->description = $request->description;
            $student_account->save();


            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('receipt_students.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store($request) {

        DB::beginTransaction();

        # Save Receipt Bond

        try {

            $receipt_bond = new ReceiptStudents();
            $receipt_bond->date = date('Y-m-d');
            $receipt_bond->student_id   = $request->student_id;
            $receipt_bond->amount       = $request->amount;
            $receipt_bond->description  = $request->description;
            $receipt_bond->save();

            # Save In Fund Account for School (Assets for this school)

            $fund_account = new FundAccounts();
            $fund_account->date         = date('Y-m-d');
            $fund_account->receipt_id   = $receipt_bond->id;
            $fund_account->Debit        = $receipt_bond->amount;
            $fund_account->credit       = 0.00;
            $fund_account->description  = $request->description;
            $fund_account->save();

            $studentAccount = new StudentsAccounts();
            $studentAccount->date       = date('Y-m-d');
            $studentAccount->type       = 'receipt';
            $studentAccount->receipt_id = $receipt_bond->id;
            $studentAccount->student_id =  $request->student_id;
            $studentAccount->Debit      = 0.00;
            $studentAccount->credit     = $receipt_bond->amount;
            $studentAccount->description = $request->description;
            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt_students.index');

        } catch(Exception $error) {

            DB::rollBack();

            return redirect()->back()->withErrors(['error' => $error->getMessage()]);

        }

    }
    
}