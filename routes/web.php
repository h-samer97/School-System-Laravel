<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProcessingFeesController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\FeesInvoiceController;
use App\Http\Controllers\StudentsAccountsController;
use App\Http\Controllers\ReceiptStudentsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

require __DIR__.'/auth.php';


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function() {
    Route::get('/', function () {
        return view('auth.login');
    })->middleware('guest');

    Route::middleware(['auth', 'verified'])->group(function () {
        
        Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Grades & Classes
        Route::resource('Grades', \App\Http\Controllers\GradeController::class);
        Route::resource('Classroom', ClassroomController::class);
        Route::resource('Section', SectionController::class);
        
        Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
        Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
        Route::get('Classes/{id}', [SectionController::class, 'getClasses']);

        // Teachers
        Route::get('teachers', [TeachersController::class, 'index'])->name('Teachers.index');
        Route::get('teachers/create', [TeachersController::class, 'create'])->name('Teachers.create');
        Route::post('teachers/store', [TeachersController::class, 'store'])->name('Teachers.store');
        Route::get('teachers/edit/{id}', [TeachersController::class, 'edit'])->name('Teachers.edit');
        Route::patch('teachers/update/{id}', [TeachersController::class, 'update'])->name('Teachers.update');
        Route::delete('teachers/destroy', [TeachersController::class, 'destroy'])->name('Teachers.destroy');

        // Students & Finance
        Route::resource('students', StudentController::class);
        Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
        Route::post('Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
        Route::get('Download_attachment/{StudentName}/{fileName}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');
        Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);
        
        Route::resource('promotions', PromotionsController::class);
        Route::resource('Graduated', GraduatedController::class);
        Route::resource('Fees', FeesController::class);
        Route::resource('Fees_Invoices', FeesInvoiceController::class);
        Route::resource('students_accounts', StudentsAccountsController::class);
        Route::resource('receipt_students', ReceiptStudentsController::class);
        Route::resource('Payment_students', PaymentController::class);
        Route::resource('ProcessingFee', ProcessingFeesController::class);
        Route::resource('Attendance', AttendanceController::class);
        Route::resource('settings', SettingController::class);
        
        // Parent
        Route::get('add-parent', function () { return view('parents.show-form'); })->name('add_parent');
    });
});