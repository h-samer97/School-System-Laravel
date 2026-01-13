<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProfileController;
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

    

	Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
	Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');


	Route::get('/', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
	Route::get('/grades_list', [GradeController::class, 'index'])->middleware(['auth', 'verified'])->name('Grade.index');

});









require __DIR__.'/auth.php';
