<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AccueilController,
    BlogController,
    ContactController,
    ExpertController,
    CategorieController,
    DevisController,
    Admin\LieuController,
    LieuPublicController
};

// Page d'accueil
Route::get('/', [AccueilController::class, 'index'])->name('home');

// Lieux (côté public)
Route::get('/lieux/{id}', [LieuPublicController::class, 'show'])->name('lieux.show');

// Blog
Route::resource('blogs', BlogController::class);
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Devis (visiteur)
Route::get('/devis', [DevisController::class, 'create'])->name('devis.create');
Route::post('/devis', [DevisController::class, 'store'])->name('devis.store');

// Experts & Catégories
Route::resource('experts', ExpertController::class);
Route::resource('categories', CategorieController::class)->only(['index', 'show']);

// Espace Admin (protégé par auth et is_admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('lieux', LieuController::class);

    Route::get('/devis', [DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/{devis}', [DevisController::class, 'show'])->name('devis.show');
    Route::delete('/devis/{devis}', [DevisController::class, 'destroy'])->name('devis.destroy');
});

// Dashboard utilisateur connecté
Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
