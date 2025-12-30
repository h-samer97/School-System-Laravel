<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
// routes/web.php

/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    
], function(){
     Route::get('/', function()
	{
		return view('dashboard');
	});

	Route::resource('grade', 'GradeController');

	
});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
