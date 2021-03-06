<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\CennikController;
use App\Http\Controllers\OfertaController;

use App\Mail\OfertaMail;
use Illuminate\Support\Facades\Mail;

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

Route::get('/statusAdd', [StatusController::class, 'index'])->middleware('auth');
Route::post('/statusAdd', [StatusController::class, 'addStatus'])->middleware('auth');
Route::get('/statusList', [StatusController::class, 'list'])->middleware('auth');
Route::get('/statusDelete/{id}', [StatusController::class, 'delete']);
Route::get('/statusEdit/{id}', [StatusController::class, 'editstatus']);
Route::post('/statusEdit', [StatusController::class, 'updatestatus']);



Route::get('/', [ClientController::class, 'list'])->middleware('auth');
Route::get('/klienciAktywni', [ClientController::class, 'listOutstanding'])->middleware('auth');

Route::get('klient/{id}', [ClientController::class, 'editData'])->middleware('auth');
Route::post('klient', [ClientController::class, 'update'])->middleware('auth');
Route::get('/klientForm', [ClientController::class, 'form'])->middleware('auth');
Route::post('/klientForm', [ClientController::class, 'insert'])->middleware('auth');

Route::get('/kalkulator/{id}', [KalkulatorController::class, 'kalkulator'])->middleware('auth');
Route::post('/kalkulator', [KalkulatorController::class, 'insert'])->middleware('auth');



Route::post('/export-excel', [ClientController::class, 'exportIntoExcel']);

Route::get('/setNieobiera/{id}', [ClientController::class, 'nieOdbiera'])->middleware('auth');

Route::get('/spotkanie/{id}', [MeetingController::class, 'form'])->middleware('auth');
Route::post('/spotkanie', [MeetingController::class, 'insert'])->middleware('auth');
Route::get('/spotkanie/edit/{id}', [MeetingController::class, 'edit'])->middleware('auth');
Route::post('/spotkanie/edit', [MeetingController::class, 'update'])->middleware('auth');

Route::get('/raport', [RaportController::class, 'userCallsDate'])->middleware('auth');
Route::post('/raport', [RaportController::class, 'userCallsDate'])->middleware('auth');

// Route::get('/cennikForm', [CennikController::class, 'form'])->middleware('auth');

Route::get('/cennik', [CennikController::class, 'list'])->middleware('auth');
Route::post('/cennik', [CennikController::class, 'insert'])->middleware('auth');

Route::get('/oferta/{id}', [OfertaController::class, 'clientList'])->middleware('auth');
Route::post('/oferta', [OfertaController::class, 'store'])->middleware('auth');



// Route::get('/email', function () {
//     Mail:: to('email@email.com')->send(new OfertaMail());
//     return new OfertaMail();
// });



// Route::get('/calendar', function (){
//     $e = Event::get();
//     // $e = $e[0];
//     dd($e);

// });





