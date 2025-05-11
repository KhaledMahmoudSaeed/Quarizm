<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoachDateController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PrivateSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [ProfileController::class, 'index'])->name("users.index");
    Route::get('/coaches', [ProfileController::class, 'coaches'])->name("coaches");// get all data about our coaches
    Route::delete('/users/{user}', [ProfileController::class, 'destroy'])->name("admin.users.destroy");

    Route::resource("/workshop", WorkshopController::class);
    Route::get("/workshops", [WorkshopController::class, 'all'])->name("Allworkshops");
    Route::get("/category/{categoryId}", [CategoryController::class, "relatedWorkshop"])->name("categoryRealatedWorkshops");
    Route::resource("/reservation", ReservationController::class);
    Route::resource("/privatesession", PrivateSessionController::class);
});
Route::resource("/coachdata", CoachDateController::class);
Route::resource("/category", CategoryController::class);

Route::get("/about", function () {
    return view("about");
})->name('about');
Route::get("/contact", function () {
    return view("contact");
})->name('contact');

Route::get('locale/{lang}', [LocalController::class, 'setLocale'])->middleware('loc');
require __DIR__ . '/auth.php';
