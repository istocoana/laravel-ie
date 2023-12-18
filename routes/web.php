<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\ParteneriController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\CosController;
use App\Http\Controllers\ComenziController;


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

Route::get('/', [WelcomeController::class, 'index']);
Route::get('contact', [WelcomeController::class, 'contact']);
Route::get('about', [WelcomeController::class, 'about']);
Route::get('contactp', [WelcomeController::class, 'contactp']);
Route::get('despre', [WelcomeController::class,'despre']);
Route::get('despresir', [WelcomeController::class,'despresir']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/contact', [WelcomeController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'sendContactForm'])->name('send');

Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
Route::get('/events/{event_id}', [EventsController::class, 'show'])->name('events.show');

Route::get('/sponsori', [SponsorController::class, 'index'])->name('sponsori.index');
Route::get('/sponsori/create', [SponsorController::class, 'create'])->name('sponsori.create');
Route::get('/sponsori/{sponsor_id}', [SponsorController::class, 'show'])->name('sponsori.show');

Route::get('/speakeri', [SpeakerController::class, 'index'])->name('speakeri.index');
Route::get('/speakeri/create', [SpeakerController::class, 'create'])->name('speakeri.create');
Route::get('/speakeri/{speaker_id}', [SpeakerController::class, 'show'])->name('speakeri.show');

Route::get('/parteneri', [ParteneriController::class, 'index'])->name('parteneri.index');
Route::get('/parteneri/create', [ParteneriController::class, 'create'])->name('parteneri.create');
Route::get('/parteneri/{partener_id}', [ParteneriController::class, 'show'])->name('parteneri.show');

Route::middleware('admin')->group(function () {
  // sponsori
  Route::get('/sponsori/create', [SponsorController::class, 'create'])->name('sponsori.create');
  Route::post('/sponsori/store', [SponsorController::class, 'store'])->name('sponsori.store');
  Route::get('/sponsori/{sponsor_id}/edit', [SponsorController::class, 'edit'])->name('sponsori.edit');
  Route::put('/sponsori/{sponsor_id}', [SponsorController::class, 'update'])->name('sponsori.update');
  Route::delete('/sponsori/{sponsor_id}', [SponsorController::class, 'destroy'])->name('sponsori.destroy');

  // speakeri
  Route::get('/speakeri/create', [SpeakerController::class, 'create'])->name('speakeri.create');
  Route::post('/speakeri/store', [SpeakerController::class, 'store'])->name('speakeri.store');
  Route::get('/speakeri/{speaker_id}/edit', [SpeakerController::class, 'edit'])->name('speakeri.edit');
  Route::put('/speakeri/{speaker_id}', [SpeakerController::class, 'update'])->name('speakeri.update');
  Route::delete('/speakeri/{speaker_id}', [SpeakerController::class, 'destroy'])->name('speakeri.destroy');

  // parteneri
  Route::get('/parteneri/create', [ParteneriController::class, 'create'])->name('parteneri.create');
  Route::post('/parteneri/store', [ParteneriController::class, 'store'])->name('parteneri.store');
  Route::get('/parteneri/{partener_id}/edit', [ParteneriController::class, 'edit'])->name('parteneri.edit');
  Route::put('/parteneri/{partener_id}', [ParteneriController::class, 'update'])->name('parteneri.update');
  Route::delete('/parteneri/{partener_id}', [ParteneriController::class, 'destroy'])->name('parteneri.destroy');

  // events
  Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
  Route::post('/events/store', [EventsController::class, 'store'])->name('events.store');
  Route::get('/events/{event_id}/edit', [EventsController::class, 'edit'])->name('events.edit');
  Route::put('/events/{event_id}', [EventsController::class, 'update'])->name('events.update');
  Route::delete('/events/{event_id}', [EventsController::class, 'destroy'])->name('events.destroy');
  Route::post('/events/{event_id}/attach-sponsors', [EventsController::class, 'attachSponsorsToEvent'])->name('events.attachSponsors');

  // comenzi
  Route::get('/comenzi/event/{event_id}', [ComenziController::class, 'comenziEveniment'])->name('comenzi.comenziEveniment');
});

Route::middleware('client')->group(function () {
  // cos
  Route::post('/adauga-in-cos',  [CosController::class, 'adaugaInCos'])->name('cos.adaugaInCos');
  Route::get('/cos', [CosController::class, 'vizualizeazaCos'])->name('cos.vizualizeazaCos');
  Route::post('/cos/adauga', [CosController::class, 'adaugaInCos'])->name('cos.adauga');
  Route::post('/cos/actualizeaza', [CosController::class, 'actualizeazaInCos'])->name('cos.actualizeaza');
  Route::delete('/cos/sterge', [CosController::class, 'stergeEveniment'])->name('cos.sterge');
  
  // comenzi
  Route::get('/formular-plata', [ComenziController::class, 'formularPlata'])->name('comenzi.formularPlata');
  Route::post('/procesare-plata', [ComenziController::class, 'procesarePlata'])->name('procesare-plata');
  Route::get('/detalii-comanda/{comanda_id}', [ComenziController::class, 'detaliiComanda'])->name('detalii-comanda');
  Route::post('/success', [ComenziController::class, 'success'])->name('success');
  Route::get('/cancel', function () {
    return view('cancel'); 
  })->name('cancel');  
  Route::get('/success-page', [ComenziController::class, 'successPage'])->name('success-page');
  Route::get('/comenzi', [ComenziController::class, 'comenzi'])->name('comenzi');
  Route::get('/descarca-pdf/{comanda_id}', [ComenziController::class, 'descarcaPDF'])->name('descarca-pdf');
});




Route::post('/procesare-plata', [ComenziController::class, 'procesarePlata'])->name('procesare-plata');
