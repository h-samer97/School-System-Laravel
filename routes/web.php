<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;

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

	Route::get('add-parent', function() {
		return view('parents.show-form');
	});

});









require __DIR__.'/auth.php';
