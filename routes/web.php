<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DoctorController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contactus', function () {
    return view('front.pages.contact');
});
Route::get('/viewbooking', function () {
    return view('front.pages.bookingdoctor');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/doctors', [HomeController::class, 'showdoctor']);
Route::get('/major', [HomeController::class, 'showmajor']);
Route::post('/bookings', [HomeController::class, 'store'])->name('bookings.store');
Route::post('/contactus', [HomeController::class, 'createcontact'])->name('contactus.store');



Route::middleware(['auth'])->group(function(){
Route::get('/majors', [MajorController::class, 'index'])->name('major.index');
Route::get('/contact', [ContactsController::class, 'index'])->name('contact.index');
Route::delete('/contact/{id}', [ContactsController::class, 'destroy'])->name('contact.destroy');
Route::get('/rate', [RateController::class, 'index'])->name('rate.index');
Route::delete('/rate/{id}', [RateController::class, 'destroy'])->name('rate.destroy');

Route::resource('doctor', DoctorController::class);
Route::resource('booking', BookingController::class);
Route::get('/majors/{id}/edit', [MajorController::class, 'edit'])->name('major.edit');
Route::put('/majors/{id}', [MajorController::class, 'update'])->name('major.update');
Route::get('/majors/{major}', [MajorController::class, 'show'])->name('major.show');

Route::get('/major/create', [MajorController::class, 'create'])->name('major.create');
Route::post('/majors', [MajorController::class, 'store'])->name('major.store');
Route::delete('/majors/{id}', [MajorController::class, 'destroy'])->name('majors.delete');
});

require __DIR__.'/auth.php';

