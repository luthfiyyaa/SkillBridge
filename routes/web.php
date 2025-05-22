<?php

use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\MentoringRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('auth/register');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');


Route::get('/datadiri', [DataDiriController::class, 'showForm'])->name('datadiri.create');
Route::post('/datadiri', [DataDiriController::class, 'submitForm'])->name('datadiri.store');

Route::get('/profil', [DataDiriController::class, 'showProfile'])->name('profil');

Route::get('/mentor', [MentorController::class, 'store'])->name('daftarmentor');
Route::get('/mentor', function () {
    return view('mentoring/daftarmentor');
});
Route::get('/mentor', [MentorController::class, 'index'])->name('mentor.index');
Route::get('/mentors/{id}', [MentorController::class, 'show'])->name('mentor.show');

Route::get('/mentoring/request/{id}', [MentoringController::class, 'request'])->name('mentoring.request');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mentor/{id}/request', [MentoringRequestController::class, 'create'])->name('mentoring.request');
Route::post('/mentor/{id}/request', [MentoringRequestController::class, 'store'])->name('mentoring.request.store');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::resource('/forum', ForumController::class)->middleware('auth');
// Route::resource('/mentoring', MentoringController::class)->middleware('auth');


require __DIR__.'/auth.php';
