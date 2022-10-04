<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

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
  return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('isAdmin')->group(function ()
{
  Route::resource('users',       UserController::Class,       ['as' => 'admins']);
  Route::resource('permissions', PermissionController::Class, ['as' => 'admins']);
});

Route::middleware(['userPermission'])->group(function ()
{
  Route::get('files',      [FileController::Class,     'Index'])->name('all.files.index');
  Route::get('categories', [CategoryController::Class, 'Index'])->name('all.categories.index');
  Route::get('courses',    [CourseController::Class,   'Index'])->name('all.courses.index');
});

require __DIR__.'/auth.php';
