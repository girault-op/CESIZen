<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BreathingModeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;



// Routes pour l'administration
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create'); // 👈 AJOUT
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit'); // 👈 AJOUT
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::post('/admin/users/{id}/deactivate', [AdminUserController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::resource('users', AdminUserController::class);
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/deactivate', [AdminUserController::class, 'deactivate'])->name('users.deactivate');
    Route::post('/users/{id}/activate', [AdminUserController::class, 'activate'])->name('users.activate');
    Route::post('users/{id}/deactivate', [AdminUserController::class, 'deactivate'])->name('users.deactivate');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->except(['destroy']); // Utilise resource pour les actions CRUD sauf destroy
    Route::delete('/users/{id}', [AdminUserController::class, 'delete'])->name('users.delete');
    Route::put('/admin/users/{id}/update-role', [AdminController::class, 'updateUserRole'])->name('admin.users.updateRole');

        // Route pour les articles administratifs
        Route::resource('posts', AdminPostController::class);
        // Route pour publier un article
    Route::post('/posts/{post}/publish', [AdminPostController::class, 'publish'])->name('posts.publish');
    Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    });
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
});


Route::get('/test-mail', function () {
    try {
        Mail::raw('Ceci est un test de mail depuis Laravel.', function ($message) {
            $message->to('votre.email@test.com')
                    ->subject('Test CESIZEN');
        });
        return 'Email envoyé avec succès ✅';
    } catch (\Exception $e) {
        return 'Erreur : ' . $e->getMessage();
    }
});

Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Groupe des routes publiques pour les articles
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index'); // /posts
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show'); // /posts/{post}
    Route::get('/category/{category}', [PostController::class, 'byCategory'])->name('posts.by_category'); // /posts/category/{category}
    Route::get('/posts', [PostController::class, 'index']); });

// Groupe des routes publiques pour les articles (côté utilisateur)
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index'); // /posts
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show'); // /posts/{post}
    Route::get('/category/{category}', [PostController::class, 'byCategory'])->name('posts.by_category'); // /posts/category/{category}
});
// Routes pour gérer les articles côté administrateur
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // /admin/posts
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); // /admin/posts/{post}/edit
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); // /admin/posts/{post}
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // /admin/posts/{post}
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class);
});

// Routes pour la gestion des utilisateurs
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tableau de bord (authentification requise)
Route::middleware('auth')->group(function () {
    // Route pour afficher le profil de l'utilisateur
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');  
    // Route pour mettre à jour le profil de l'utilisateur
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route pour supprimer le profil de l'utilisateur
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route pour mettre à jour l'avatar de l'utilisateur
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    // Route pour mettre à jour le mot de passe de l'utilisateur
    Route::get('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        // Route pour afficher le tableau de bord
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    // Route::post('/profile/update', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::post('/coherence-cardiaque', [ProfileController::class, 'storeCoherenceCardiaqueData'])->name('coherence.store');

Route::get('/check-password-form', function () {
    return view('check-password');
});
Route::post('/check-password', [RegisteredUserController::class, 'checkPassword'])->name('check.password');

// Modes de respiration
Route::get('/breathing-modes', [BreathingModeController::class, 'index'])->name('breathing-modes.index');
Route::get('/breathing-modes/test', function () {
    return view('breathing-modes.test');
})->name('breathing-modes.test');

// Gestion des utilisateurs
Route::resource('users', UserController::class);

// Gestion des catégories
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
// Route pour afficher le formulaire de création de catégorie
Route::get('/articles', [PostController::class, 'index'])->name('articles.index');
Route::get('/admin/articles/{article}', [PostController::class, 'show'])->name('admin.articles.show');
Route::get('/admin/articles/{article}/edit', [PostController::class, 'edit'])->name('admin.articles.edit');
Route::put('/admin/articles/{article}', [PostController::class, 'update'])->name('admin.articles.update');
//Route::get('/register', function () {
    // return view('register');
// });

// Routes pour les invités (non authentifiés)
Route::middleware('web')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

// Routes pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {

    // Déconnexion
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // Vérification d'email
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

        Route::post('/breathing-mode/session',[BreathingModeController::class, 'createSession']);

    // Confirmation de mot de passe
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Mise à jour du mot de passe
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});

// Réinitialisation de mot de passe
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');