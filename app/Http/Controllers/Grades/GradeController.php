<?php 

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Grade;
// use 

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
     $Grades = Grade::all();
     return response()->view('grades.grade', compact('Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      try {
          $valid = $request->validate([
          'Name' => 'required|string|max:255',
        ]);

        $GradeModel = new Grade();
        $GradeModel->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $GradeModel->Notes = ['en' => $request->Notes];
        $GradeModel->save();
        // Display a success toast with no title
        flash()->success(trans('messages.success'));

        return redirect()->route('Grade.index');

      } catch(Exception $error) {

          flash()->error('Error ' . $error);
          return redirect()->route('Grade.index');

      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {

    $Grades = Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists();

    if($Grades) {
        return redirect()->route('Grade.index')->withErrors([trans('Grades_trans.exists')]);
    }
    
    try {

          $valid = $request->validate([
          'Name' => 'string|min:3|max:50'
      ]);

      $Grade = Grade::findOrFail($request->id);
      $Grade->update([
        $Grade->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
        $Grade->Notes = $request->Notes
      ]);
      flash()->success(trans('messages.success'));
      return redirect()->route('Grade.index');

    } catch(Exception $error) {

        return redirect()->back()->withErrors(['error' => $error->getMessage()]);

    }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
      
      try {

          $Grades = Grade::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.success'));
          return redirect()->route('Grade.index');

      } catch(Exception $error) {

        return redirect()->back()->withErrors(['error' => $error->getMessage()]);

    }

  }
  
}

?>