<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidationRequestController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProductLabelController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('products')->group(function () {
    Route::get('/', [PublicProductController::class, 'index'])->name('public.products.index');
    Route::get('/{product}', [PublicProductController::class, 'show'])->name('public.products.show');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Redirect sesuai role
    if ($user->role === 'Admin') {
        return redirect()->intended(route('admin.dashboard'));
    }

    if ($user->role === 'UMKM') {
        return redirect()->intended(route('umkm.dashboard'));
    }

    if ($user->role === 'Regulator') {
        return redirect()->intended(route('regulator.dashboard'));
    }

    // fallback kalau role tidak dikenal
    return abort(403, 'Role tidak dikenali.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Edit profil sendiri
    Route::get('/profile/edit', [UserController::class, 'editSelf'])->name('users.edit.self');
    Route::put('/profile/update', [UserController::class, 'updateSelf'])->name('users.update.self');
});

// Admin: Kelola semua user
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('admin.audit.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // UMKM submit
    Route::post('/umkm/products/{product}/submit-validation', [ValidationRequestController::class, 'store'])
        ->name('validation.submit');

    // Admin review
    Route::middleware('admin')->group(function () {
        Route::get('/admin/validation-requests', [ValidationRequestController::class, 'index'])
            ->name('admin.validation.index');
        Route::put('/admin/validation-requests/{validationRequest}', [ValidationRequestController::class, 'update'])
            ->name('admin.validation.update');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('admin.dashboard');
    // Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::get('/admin/ingredients', [IngredientController::class, 'index'])->name('admin.ingredients.index');
    Route::post('/admin/ingredients', [IngredientController::class, 'store'])->name('admin.ingredients.store');
    Route::put('/admin/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('admin.ingredients.update');
    Route::delete('/admin/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('admin.ingredients.destroy');
    Route::post('/admin/ingredients/import', [IngredientController::class, 'import'])
        ->name('admin.ingredients.import')
        ->middleware(['auth', 'admin']);
});

Route::middleware(['auth', 'regulator'])->group(function () {
    // Dashboard regulator
    Route::get('/regulator/dashboard', [App\Http\Controllers\Regulator\DashboardController::class, 'index'])
        ->name('regulator.dashboard');

    // Audit logs
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('regulator.audit.index');

    // Validasi produk (pakai controller admin yang sama)
    Route::get('/regulator/validation-requests', [ValidationRequestController::class, 'index'])->name('regulator.validation.index');
    Route::get('/regulator/validation-requests/{validationRequest}', [ValidationRequestController::class, 'show'])->name('regulator.validation.show');
    Route::put('/regulator/validation-requests/{validationRequest}', [ValidationRequestController::class, 'update'])->name('regulator.validation.update');
});

Route::middleware(['auth', 'umkm'])->group(function () {
    Route::get('/umkm/dashboard', [App\Http\Controllers\Umkm\DashboardController::class, 'index'])
        ->name('umkm.dashboard');
    Route::resource('/umkm/products', App\Http\Controllers\ProductController::class);

    Route::get('/umkm/products/{product}/ingredients', [App\Http\Controllers\ProductIngredientController::class, 'index'])
        ->name('product.ingredients.index');

    Route::post('/umkm/products/{product}/ingredients', [App\Http\Controllers\ProductIngredientController::class, 'store'])
        ->name('product.ingredients.store');

    Route::delete('/umkm/products/{product}/ingredients/{productIngredient}', [App\Http\Controllers\ProductIngredientController::class, 'destroy'])
        ->name('product.ingredients.destroy');

    Route::get('/umkm/products/{product}/nutrition', [App\Http\Controllers\ProductNutritionController::class, 'show'])
        ->name('product.nutrition.show');

    Route::get('/products/{product}/label', [ProductLabelController::class, 'show'])
        ->name('products.label.show');

    Route::get('/umkm/products/{product}/label/pdf', [ProductLabelController::class, 'pdf'])
        ->name('products.label.pdf');
});

require __DIR__.'/auth.php';
