<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\WorkLogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  function (){
    return redirect()->route('employee.index');
})->name('home');

Route::group(['prefix' => '/employees'], function (){
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('/import', [EmployeeController::class, 'import'])->name('employee.import');
    Route::get('/show-import', [EmployeeController::class, 'showImport'])->name('employee.showImport');
});


Route::group(['prefix' => '/work-logs'], function (){
    Route::get('/', [WorkLogController::class, 'index'])->name('workLog.index');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
