<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use Illuminate\Auth\Middleware\Authenticate;
use Spatie\GoogleCalendar\Event;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/import-form', [ClientController::class, 'importForm'])->middleware('auth');
Route::post('/import', [ClientController::class, 'import'])->name('client.import');
Route::get('/addstatus', [StatusController::class, 'index'])->middleware('auth');
Route::post('/addstatus', [StatusController::class, 'addStatus'])->middleware('auth');
Route::get('/liststatus', [StatusController::class, 'list'])->middleware('auth');

Route::get('/delete/{id}', [StatusController::class, 'delete']);

Route::get('/editstatus/{id}', [StatusController::class, 'editstatus']);
Route::post('/editstatus', [StatusController::class, 'updatestatus']);



Route::get('/', [ClientController::class, 'list'])->middleware('auth');
Route::get('/listactive', [ClientController::class, 'listOutstanding'])->middleware('auth');

Route::get('editclient/{id}', [ClientController::class, 'editData'])->middleware('auth');
Route::post('editclient', [ClientController::class, 'update'])->middleware('auth');
Route::post('/export-excel', [ClientController::class, 'exportIntoExcel']);

// Route::get('/calendar', function (){
//     $e = Event::get();
//     // $e = $e[0];
//     dd($e);

// });





