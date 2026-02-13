<?php

    namespace App\Repository;

    use App\Models\Fees;
    use App\Models\Grade;
    use Exception;


    class FeesRepository implements IFees {



        public function index() {

            $fees = Fees::all();
            $Grades = Grade::all();
            return view('fees.index', compact('fees', 'Grades'));

        }

        public function store($request) {

            try {

                $fees = new Fees();
                $fees->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
                $fees->amount = $request->amount;
                $fees->Grade_id = $request->Grade_id;
                $fees->classroom_id = $request->Classroom_id;
                $fees->year = $request->year;
                $fees->description = $request->description;
                $fees->fee_type = $request->Fee_type;

                $fees->save();

                toastr()->success(trans('messages.success'));
                return redirect()->route('Fees.create');

            } catch(Exception $error) {
                return redirect()->back()->withErrors(['error' => $error->getMessage()]);
            }

        }

        public function edit($id) {
            $fee = Fees::findOrFail($id);
            $Grades = Grade::all();
            return view('Fees.edit',compact('fee','Grades'));
        }

        
    public function update($request)
    {
        try {
            $fees = Fees::findorfail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Classroom_id  =$request->Classroom_id;
            $fees->description  =$request->description;
            $fees->year  =$request->year;
            $fees->Fee_type  =$request->Fee_type;
            $fees->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees.index');
        }

        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

     public function create(){

        $Grades = Grade::all();
        return view('Fees.add',compact('Grades'));
    }

    public function destroy($request) {
       try {
            Fees::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    }


















?>