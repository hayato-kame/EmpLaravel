<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartmentsController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/departments', [ DepartmentsController::class, 'index' ])->name('departments.index');
Route::get('/departments/new_entry_edit', [ DepartmentsController::class, 'new_entry_edit' ])->name('departments.new_entry_edit');
Route::post('/departments/dep_control', [ DepartmentsController::class, 'dep_control' ])->name('departments.dep_control');

