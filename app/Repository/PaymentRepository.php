<?php


namespace App\Repository;

use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentsAccounts;
use App\Providers\FundAccounts;
use DB;

class PaymentRepository implements IPayment {



        public function index() {
            $payment_students = Payment::all();
            return view('payment.index',compact('payment_students'));
        }

        public function show($id) {

             $student = Student::findorfail($id);
            return view('payment.add',compact('student'));

        }

        public function edit($id) {

            $payment_student = Payment::findOrFail($id);
            return view('payment.edit',compact('payment_student'));


        }

        public function update($request) {
            DB::beginTransaction();

            try {

                $payment = Payment::findOrFail($request->id);
                $payment->date          = date('Y-m-d');
                $payment->student_id    = $request->student_id;
                $payment->amount        = $request->final_balance;
                $payment->description   = $request->description;
                $payment->save();

                $fund_accounts = \App\Models\FundAccounts::where('payment_id',$request->id)->first();
                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->payment_id = $payment->id;
                $fund_accounts->Debit = 0.00;
                $fund_accounts->credit = $request->Debit;
                $fund_accounts->description = $request->description;
                $fund_accounts->save();

                $students_accounts = StudentsAccounts::where('payment_id',$request->id)->first();
                $students_accounts->date = date('Y-m-d');
                $students_accounts->type = 'payment';
                $students_accounts->student_id = $request->student_id;
                $students_accounts->payment_id = $payment->id;
                $students_accounts->Debit = $request->Debit;
                $students_accounts->credit = 0.00;
                $students_accounts->description = $request->description;
                $students_accounts->save();

                 DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

        public function store($request) {

            DB::beginTransaction();

            try {

                $payment = new Payment();
                $payment->date          = date('Y-m-d');
                $payment->student_id    = $request->student_id;
                $payment->amount        = $request->final_balance;
                $payment->description   = $request->description;
                $payment->save();

                $fund_accounts = new \App\Models\FundAccounts();
                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->payment_id = $payment->id;
                $fund_accounts->Debit = 0.00;
                $fund_accounts->credit = $request->Debit;
                $fund_accounts->description = $request->description;
                $fund_accounts->save();

                $students_accounts = new StudentsAccounts();
                $students_accounts->date = date('Y-m-d');
                $students_accounts->type = 'payment';
                $students_accounts->student_id = $request->student_id;
                $students_accounts->payment_id = $payment->id;
                $students_accounts->Debit = $request->Debit;
                $students_accounts->credit = 0.00;
                $students_accounts->description = $request->description;
                $students_accounts->save();

                 DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

            }


             public function destroy($request)
            {
                try {
                    Payment::destroy($request->id);
                    toastr()->error(trans('messages.Delete'));
                    return redirect()->back();
                }

                catch (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            }

        }