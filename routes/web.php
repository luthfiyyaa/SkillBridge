<?php

use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\MentoringRequestController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\CategoryTestController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\NotifikasiController;
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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


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

Route::get('/daftar-test', [CategoryTestController::class, 'index'])->name('tests.index'); 
Route::get('/detail-test/{id}', [CategoryTestController::class, 'show'])->name('tests.show');

Route::get('/soal-test', [TestController::class, 'showTestForm'])->name('test.soal');
Route::get('/soal-test', [TestController::class, 'showQuestion'])->name('test.question');

Route::post('/save-answer', [TestController::class, 'saveAnswer'])->name('test.save');
Route::get('/hasil-test', [TestController::class, 'showResult'])->name('test.result');
Route::get('/riwayat-test', [TestController::class, 'history'])->name('test.history');
Route::post('/submit-test', [TestController::class, 'submitTest'])->name('test.submit');

Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/buat-post', [ForumController::class, 'create'])->name('forum.create');
Route::post('/buat-post', [ForumController::class, 'store'])->name('forum.store');

Route::get('/postingan/{id}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/postingan/{id}', [ForumController::class, 'kirimKomentar'])->name('forum.kirimKomentar');

Route::get('/rekom-lowongan', [LowonganController::class, 'index'])->name('rekom.lowongan');
Route::get('/detail-lowongan/{id}', [LowonganController::class, 'show'])->name('detail.lowongan');
Route::get('/apply-lamaran/{id}', [LamaranController::class, 'create'])->name('lamaran.create');
Route::post('/apply-lamaran', [LamaranController::class, 'store'])->name('lamaran.store');
Route::get('/riwayat-lamaran', [LamaranController::class, 'index'])->name('lamaran.index');

Route::get('/edit-porto', [PortofolioController::class, 'edit'])->name('porto.edit');
Route::post('/edit-porto', [PortofolioController::class, 'update'])->name('porto.update');
Route::get('/portofolio', [PortofolioController::class, 'show'])->name('porto.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'tandaiSudahDibaca'])->name('notifikasi.baca');
});

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::resource('/forum', ForumController::class)->middleware('auth');
// Route::resource('/mentoring', MentoringController::class)->middleware('auth');


require __DIR__.'/auth.php';
