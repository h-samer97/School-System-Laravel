<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\FeesInvoiceController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\ReceiptStudentsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentsAccountsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
	
	Route::middleware('auth')->group(function () {
		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	});

	Route::group(['middleware' => ['guest']], function() {
		Route::get('/', function() {
			return view('auth.login');
		});
	});

	Route::resource('Grades', GradeController::class);
	Route::resource('Classroom', ClassroomController::class);
	Route::resource('Section', ClassroomController::class);

    

	Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
	Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');


	Route::get('sections', [SectionController::class, 'index']);
	Route::post('sections/store', [SectionController::class, 'store'])->name('Sections.store');


	Route::get('/', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
	Route::get('/grades_list', [GradeController::class, 'index'])->middleware(['auth', 'verified'])->name('Grade.index');
	Route::get('Classes/{id}', [SectionController::class, 'getClasses']);
	Route::get('teachers', [TeachersController::class, 'index'])->name('teachers');
	Route::get('teachers/create', [TeachersController::class, 'create'])->name('Teachers.create');
	Route::post('teachers/store', [TeachersController::class, 'store'])->name('Teachers.store');
	Route::get('teachers/edit{id}', [TeachersController::class, 'edit'])->name('Teachers.edit');
	Route::patch('teachers/update{id}', [TeachersController::class, 'update'])->name('Teachers.update');
	Route::delete('teachers/destroy', [TeachersController::class, 'destroy'])->name('Teachers.destroy');

	Route::get('add-parent', function () {
		return view('parents.show-form');
	});

	// ==================  Students =====================

	Route::resource('students', StudentController::class);
	Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
	Route::get('Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
	Route::get('Download_attachment', [StudentController::class, 'Download_attachment'])->name('Download_attachment');

	// ================= Promotions Students ====================================
	Route::resource('promotions', PromotionsController::class);
	// ================= Graduated Students ====================================

	Route::resource('Graduated', GraduatedController::class);
	Route::resource('Fees', FeesController::class);
	Route::resource('fees_invoices', FeesInvoiceController::class);
	Route::resource('students_accounts', StudentsAccountsController::class);
	Route::resource('receipt_students', ReceiptStudentsController::class);
	Route::resource('ProcessingFee', ProfileController::class);
	Route::resource('Payment_students', PaymentController::class);
	Route::resource('Attendance', AttendanceController::class);
	Route::resource('subjects', SubjectController::class);
	  Route::resource('Exams', 'ExamController');
	    Route::resource('Quizzes', 'QuizzController');
		Route::resource('questions', 'QuestionController');
	
	});
	
	
	Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
	Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);








require __DIR__.'/auth.php';
