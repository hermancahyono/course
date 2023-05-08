`<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\MyCourseController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ShowcaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// admin route
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function(){
    // admin dashboard route
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    // admin category route resource
    Route::resource('category', CategoryController::class);
    // admin course route resource
    Route::resource('course', CourseController::class);
    Route::get('/my-course', MyCourseController::class)->name('mycourse');
    //admin video route
    Route::controller(VideoController::class)->as('video.')->group(function(){
       Route::get('/{course:slug}/video', 'index')->name('index');
       Route::get('/{course:slug}/create', 'create')->name('create');
       Route::post('/{course:slug}/store', 'store')->name('store');
       Route::get('/edit/{course:slug}/{video}', 'edit')->name('edit');
       Route::put('/update/{course:slug}/{video}', 'update')->name('update');
       Route::delete('/delete/{video}', 'destroy')->name('destroy');
    });
    // admin showcase route
    Route::get('/showcase', ShowcaseController::class)->name('showcase.index');
});
