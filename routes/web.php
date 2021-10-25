<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientAllController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\CennikController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\SourceclientController;
use App\Http\Controllers\RozmowyController;
use App\Http\Controllers\StatusFotoController;
use App\Http\Controllers\PradController;
use App\Http\Controllers\DostawcaPradController;
use App\Http\Controllers\TaryfaPradController;
use App\Http\Controllers\DystrybucjaPradController; 
use App\Http\Controllers\KampaniaPradController;
use App\Http\Controllers\StatusPradController; 
use App\Http\Controllers\UsersController; 
use App\Http\Controllers\FtpController; 
use App\Http\Controllers\PradBackUmowaController; 
use App\Http\Controllers\LogUserController; 
use App\Http\Controllers\FotoOfertaEmailController; 
use App\Http\Controllers\ClientBranzaController; 

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/import-form', [ClientController::class, 'importForm'])->middleware('auth');
Route::post('/import', [ClientController::class, 'import'])->name('client.import');

Route::get('/statusAdd', [StatusController::class, 'index'])->middleware('auth');
Route::post('/statusAdd', [StatusController::class, 'addStatus'])->middleware('auth');
Route::get('/statusList', [StatusController::class, 'list'])->middleware('auth');
Route::get('/statusDelete/{id}', [StatusController::class, 'delete']);
Route::get('/statusEdit/{id}', [StatusController::class, 'editstatus']);
Route::post('/statusEdit', [StatusController::class, 'updatestatus']);

Route::get('/sourceList', [SourceclientController::class, 'list'])->middleware('auth');
Route::get('/sourceAdd', [SourceclientController::class, 'index'])->middleware('auth');
Route::post('/sourceAdd', [SourceclientController::class, 'add'])->middleware('auth');
Route::get('/sourceEdit/{id}', [SourceclientController::class, 'edit']);
Route::post('/sourceEdit', [SourceclientController::class, 'update']);
Route::get('/sourceDelete/{id}', [SourceclientController::class, 'delete']);

Route::get('/statutesFotoList', [StatusFotoController::class, 'list'])->middleware('auth');
Route::get('/statusesFotoAdd', [StatusFotoController::class, 'index'])->middleware('auth');
Route::post('/statusesFotoAdd', [StatusFotoController::class, 'add'])->middleware('auth');
Route::get('/statutesFotoEdit/{id}', [StatusFotoController::class, 'edit']);
Route::post('/statutesFotoEdit', [StatusFotoController::class, 'update']);
Route::get('/statutesFotoDelete/{id}', [StatusFotoController::class, 'delete']);

Route::get('/dostawcaPradList', [DostawcaPradController::class, 'list'])->middleware('auth');
Route::get('/dostawcaPradAdd', [DostawcaPradController::class, 'index'])->middleware('auth');
Route::post('/dostawcaPradAdd', [DostawcaPradController::class, 'add'])->middleware('auth');
Route::get('/dostawcaPradEdit/{id}', [DostawcaPradController::class, 'edit']);
Route::post('/dostawcaPradEdit', [DostawcaPradController::class, 'update']);
Route::get('/dostawcaPradDelete/{id}', [DostawcaPradController::class, 'delete']);

Route::get('/taryfaPradList', [TaryfaPradController::class, 'list'])->middleware('auth');
Route::get('/taryfaPradAdd', [TaryfaPradController::class, 'index'])->middleware('auth');
Route::post('/taryfaPradAdd', [TaryfaPradController::class, 'add'])->middleware('auth');
Route::get('/taryfaPradEdit/{id}', [TaryfaPradController::class, 'edit']);
Route::post('/taryfaPradEdit', [TaryfaPradController::class, 'update']);
Route::get('/taryfaPradDelete/{id}', [TaryfaPradController::class, 'delete']);

Route::get('/dystrybucjaPradList', [DystrybucjaPradController::class, 'list'])->middleware('auth');
Route::get('/dystrybucjaPradAdd', [DystrybucjaPradController::class, 'index'])->middleware('auth');
Route::post('/dystrybucjaPradAdd', [DystrybucjaPradController::class, 'add'])->middleware('auth');
Route::get('/dystrybucjaPradEdit/{id}', [DystrybucjaPradController::class, 'edit']);
Route::post('/dystrybucjaPradEdit', [DystrybucjaPradController::class, 'update']);
Route::get('/dystrybucjaPradDelete/{id}', [DystrybucjaPradController::class, 'delete']);

Route::get('/kampaniaPradList', [KampaniaPradController::class, 'list'])->middleware('auth');
Route::get('/kampaniaPradAdd', [KampaniaPradController::class, 'index'])->middleware('auth');
Route::post('/kampaniaPradAdd', [KampaniaPradController::class, 'add'])->middleware('auth');
Route::get('/kampaniaPradEdit/{id}', [KampaniaPradController::class, 'edit']);
Route::post('/kampaniaPradEdit', [KampaniaPradController::class, 'update']);
Route::get('/kampaniaPradDelete/{id}', [KampaniaPradController::class, 'delete']);

Route::get('/ClientBranzaList', [ClientBranzaController::class, 'list'])->middleware('auth');
Route::get('/ClientBranzaAdd', [ClientBranzaController::class, 'index'])->middleware('auth');
Route::post('/ClientBranzaAdd', [ClientBranzaController::class, 'add'])->middleware('auth');
Route::get('/ClientBranzaEdit/{id}', [ClientBranzaController::class, 'edit']);
Route::post('/ClientBranzaEdit', [ClientBranzaController::class, 'update']);
Route::get('/ClientBranzaDelete/{id}', [ClientBranzaController::class, 'delete']);

Route::get('/userList', [UsersController::class, 'list'])->middleware('auth');
Route::get('/userAdd', [UsersController::class, 'index'])->middleware('auth');
Route::post('/userAdd', [UsersController::class, 'add'])->middleware('auth');
Route::get('/userEdit/{id}', [UsersController::class, 'edit']);
Route::post('/userEdit', [UsersController::class, 'update']);
Route::get('/userDelete/{id}', [UsersController::class, 'delete']);

Route::get('/statusOfertaPradList', [StatusPradController::class, 'list'])->middleware('auth');
Route::get('/statusOfertaPradAdd', [StatusPradController::class, 'index'])->middleware('auth');
Route::post('/statusOfertaPradAdd', [StatusPradController::class, 'add'])->middleware('auth');
Route::get('/statusOfertaPradEdit/{id}', [StatusPradController::class, 'edit']);
Route::post('/statusOfertaPradEdit', [StatusPradController::class, 'update']);
Route::get('/statusOfertaPradDelete/{id}', [StatusPradController::class, 'delete']);

Route::get('/', [ClientController::class, 'list'])->middleware('auth');
Route::get('/klienciAktywni', [ClientController::class, 'listOutstanding'])->middleware('auth');
Route::get('/klienciNieAktywni', [ClientController::class, 'listNonActive'])->middleware('auth');

Route::get('/klienciAll', [ClientAllController::class, 'index'])->middleware('auth');
Route::get('/klienciAll/action', [ClientAllController::class, 'action'])->name('klienciAll.action')->middleware('auth');

Route::post('/statusPrad', [StatusPradController::class, 'ajaxStatus'])->name('statusPrad.save')->middleware('auth');


// Route::get('/live_search', [ClientAllController::class, 'index']);
// Route::get('/live_search/action', [ClientAllController::class, 'action'])->name('live_search.action');

Route::get('klient/{id}', [ClientController::class, 'editData'])->middleware('auth');
Route::post('klient', [ClientController::class, 'updateKlient'])->middleware('auth');
Route::get('/klientForm', [ClientController::class, 'formKlient'])->middleware('auth');
Route::post('/klientForm', [ClientController::class, 'insertKlient'])->middleware('auth');

Route::get('/pradFakturaForm/{id}', [PradController::class, 'formFaktura'])->middleware('auth');
Route::post('/pradFakturaForm', [PradController::class, 'insertFaktura'])->middleware('auth');
Route::get('/pradFakturaEdit/{id}', [PradController::class, 'editFaktura'])->middleware('auth');
Route::post('/pradFakturaUpdate', [PradController::class, 'updateFaktura'])->middleware('auth');
Route::get('/pradFakturaArchiwum/{id}', [PradController::class, 'archFaktura'])->middleware('auth');



Route::get('/pradOfertaForm/{id}', [PradController::class, 'form'])->middleware('auth');
Route::post('/pradOfertaForm', [PradController::class, 'insert'])->middleware('auth');
Route::get('/pradOfertaEdit/{id}', [PradController::class, 'editOferta'])->middleware('auth');
Route::post('/pradOfertaUpdate', [PradController::class, 'updateOferta'])->middleware('auth');
Route::get('/pradOfertaArchiwum/{id}', [PradController::class, 'archOferta'])->middleware('auth');

Route::get('/pradUmowaForm/{id}', [PradController::class, 'formUmowa'])->middleware('auth');
Route::post('/pradUmowaForm', [PradController::class, 'insertUmowa'])->middleware('auth');
Route::get('/pradUmowaEdit/{id}', [PradController::class, 'editUmowa'])->middleware('auth');
Route::post('/pradUmowaUpdate', [PradController::class, 'updateUmowa'])->middleware('auth');
Route::get('/pradUmowaArchiwum/{id}', [PradController::class, 'archUmowa'])->middleware('auth');

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

Route::post('/ftpback', [FtpController::class, 'store'])->name('file.export')->middleware('auth');
Route::get('/ftpback/{id}', [FtpController::class, 'form'])->middleware('auth');


// Route::get('/cennikForm', [CennikController::class, 'form'])->middleware('auth');

Route::get('/cennik', [CennikController::class, 'list'])->middleware('auth');
Route::post('/cennik', [CennikController::class, 'insert'])->middleware('auth');

Route::get('/oferta/{id}', [OfertaController::class, 'clientList'])->middleware('auth');
Route::post('/oferta', [OfertaController::class, 'store'])->middleware('auth');

Route::post('/rozmowy', [RozmowyController::class, 'update'])->middleware('auth');

Route::post('/fotosave', [StatusFotoController::class, 'updateFoto'])->middleware('auth');
Route::post('/pradsave', [StatusPradController::class, 'updateStatus'])->middleware('auth');


Route::get('/log', [LogUserController::class, 'log_list'])->middleware('auth');

Route::get('/fotoOfertaMail/{id}', [OfertaController::class, 'fotoOfertaMail'])->middleware('auth');


// Route::get('/email', function () {
//     Mail:: to('email@email.com')->send(new OfertaMail());
//     return new OfertaMail();
// });



// Route::get('/calendar', function (){
//     $e = Event::get();
//     // $e = $e[0];
//     dd($e);

// });





