<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\InfographicController as AdminInfographicController;
use App\Http\Controllers\Admin\MapPointController as AdminMapPointController;
use App\Http\Controllers\Admin\MsmeController as AdminMsmeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\VillagePotentialController as AdminVillagePotentialController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfographicController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MsmeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VillagePotentialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-desa', [ProfileController::class, 'index'])->name('profile');
Route::get('/infografis', [InfographicController::class, 'index'])->name('infographics');
Route::get('/peta-desa', [MapController::class, 'index'])->name('map');
Route::get('/umkm', [MsmeController::class, 'index'])->name('msmes.index');
Route::get('/umkm/{slug}', [MsmeController::class, 'show'])->name('msmes.show');
Route::get('/potensi-desa', [VillagePotentialController::class, 'index'])->name('potentials.index');
Route::get('/potensi-desa/{slug}', [VillagePotentialController::class, 'show'])->name('potentials.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('/profil-desa', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil-desa', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::resource('infografis', AdminInfographicController::class)
            ->except(['show'])
            ->parameters(['infografis' => 'infografis']);
        Route::resource('peta-desa', AdminMapPointController::class)
            ->except(['show'])
            ->parameters(['peta-desa' => 'peta_desa']);
        Route::resource('umkm', AdminMsmeController::class)
            ->except(['show'])
            ->parameters(['umkm' => 'msme']);
        Route::resource('potensi-desa', AdminVillagePotentialController::class)
            ->except(['show'])
            ->parameters(['potensi-desa' => 'potensi_desa']);
        Route::resource('galeri', AdminGalleryController::class)
            ->except(['show'])
            ->parameters(['galeri' => 'galeri']);
        Route::resource('kontak', AdminContactController::class)
            ->except(['show'])
            ->parameters(['kontak' => 'kontak']);

        Route::get('/pengaturan', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/pengaturan', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
