<?php

use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\MentoringRequestController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\CategoryTestController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return view('dashboard.index'); // menampilkan landing page
})->name('home');

// Route::get('/', function () {
//     return view('auth/register');
// });

Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/datadiri', [DataDiriController::class, 'showForm'])->name('datadiri.create');
    Route::post('/datadiri', [DataDiriController::class, 'submitForm'])->name('datadiri.store');
    Route::get('/profil', [DataDiriController::class, 'showProfile'])->name('profil');
});

Route::get('/mentor', [MentorController::class, 'store'])->name('daftarmentor');
Route::get('/mentor', function () {
    return view('mentoring/daftarmentor');
});
Route::get('/mentor', [MentorController::class, 'index'])->name('mentor.index');
Route::get('/mentors/{id}', [MentorController::class, 'show'])->name('mentor.show');

Route::get('/mentoring/request/{id}', [MentoringController::class, 'request'])->name('mentoring.request');
Route::post('/mentoring/store', [MentoringRequestController::class, 'store'])->name('mentoring.store');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/mentor/{id}/request', [MentoringRequestController::class, 'create'])->name('mentoring.request');
Route::post('/mentoring/store', [MentoringRequestController::class, 'store'])->name('mentoring.store');


Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal/action', [JadwalController::class, 'handleAction'])->name('jadwal.action');

Route::get('/review-mentoring', [RiwayatController::class, 'index'])->name('review.index');
Route::post('/review-mentoring', [RiwayatController::class, 'store'])->name('review.store');

Route::get('/category-test', [CategoryTestController::class, 'index'])->name('tests.index'); 
Route::get('/detail-test/{id}', [CategoryTestController::class, 'show'])->name('tests.show');

Route::get('/soal-test', [TestController::class, 'showTestForm'])->name('test.soal');
Route::get('/soal-test', [TestController::class, 'showQuestion'])->name('test.question');

Route::post('/save-answer', [TestController::class, 'saveAnswer'])->name('test.save');
Route::get('/hasil-test', [TestController::class, 'showResult'])->name('test.result');
Route::get('/riwayat-test', [TestController::class, 'history'])->name('test.history');

Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/buat-post', [ForumController::class, 'create'])->name('forum.create');
Route::post('/buat-post', [ForumController::class, 'store'])->name('forum.store');
Route::get('/postingan/{id}', [ForumController::class, 'show'])->name('forum.show');


// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::resource('/forum', ForumController::class)->middleware('auth');
// Route::resource('/mentoring', MentoringController::class)->middleware('auth');


require __DIR__.'/auth.php';
