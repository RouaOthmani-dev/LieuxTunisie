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
    Admin\AdminBlogController,
    LieuPublicController,
    NewPasswordController,
    PasswordResetLinkController,
    ProfileController

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
Route::get('/experts', [ExpertController::class, 'index'])->name('experts.index');

Route::resource('categories', CategorieController::class)->only(['index', 'show']);

// Espace Admin (protégé par auth et is_admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        $expert = \App\Models\Expert::first(); // Charger le premier expert
        return view('admin.dashboard', compact('expert')); // Passer l'expert à la vue
    })->name('dashboard');

    // Ressource lieux avec paramètre singulier 'lieu'
    Route::resource('lieux', LieuController::class)->parameters([
        'lieux' => 'lieu',
    ]);

    // Routes devis
    Route::get('/devis', [DevisController::class, 'index'])->name('devis.index');
    Route::get('/devis/{devis}', [DevisController::class, 'show'])->name('devis.show');
    Route::delete('/devis/{devis}', [DevisController::class, 'destroy'])->name('devis.destroy');
    Route::post('/devis', [DevisController::class, 'store'])->name('devis.store');


    // Ressource blog
    Route::resource('blog', AdminBlogController::class);

    // Routes Expert (édition, mise à jour, suppression)
    Route::get('expert/{expert}/edit', [ExpertController::class, 'edit'])->name('expert.edit');
    Route::put('expert/{expert}', [ExpertController::class, 'update'])->name('expert.update');
    Route::delete('expert/{expert}', [ExpertController::class, 'destroy'])->name('expert.destroy');

    // === Routes Contact (admin) ajoutées ===
    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contacts/{id}', [ContactController::class, 'showMessage'])->name('contact.show');

});


// Dashboard utilisateur connecté
Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



// Afficher le formulaire de réinitialisation de mot de passe
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

// Traiter l'envoi du nouveau mot de passe
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

  
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::get('/confidentialite',function(){
    return view('confidentialite');
})->name('confidentialite');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
