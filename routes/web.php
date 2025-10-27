<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CondominioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\ImovelController;
use App\Http\Controllers\DatabaseTestController;
use App\Http\Controllers\Auth\LoginController;

// Redirecionar para o dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rotas de Autenticação
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/2fa', [LoginController::class, 'show2faForm'])->name('2fa.show');
    Route::post('/2fa', [LoginController::class, 'verify2fa'])->name('2fa.verify');
    Route::get('/2fa/resend', [LoginController::class, 'resend'])->name('2fa.resend');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Teste de banco de dados
    Route::get('/database-test', [DatabaseTestController::class, 'index'])->name('database.test');

    // Users CRUD
    Route::resource('users', UserController::class);

    // Veículos CRUD
    Route::resource('veiculos', VeiculoController::class);

    // Imóveis CRUD
    Route::resource('imoveis', ImovelController::class);

    // API Routes para Prisma/Supabase
    Route::prefix('api')->group(function () {
        Route::get('/condominios', [CondominioController::class, 'index'])->name('api.condominios');
        Route::get('/condominios/{id}/imoveis', [CondominioController::class, 'imoveis'])->name('api.condominios.imoveis');
        Route::get('/sync-status', [CondominioController::class, 'syncStatus'])->name('api.sync.status');
    });

    // Busca
    Route::get('/search', [DashboardController::class, 'search'])->name('search');

    // UI Elements
    Route::get('/ui/buttons', function () {
        return view('ui.buttons');
    })->name('ui.buttons');

    Route::get('/ui/dropdowns', function () {
        return view('ui.dropdowns');
    })->name('ui.dropdowns');

    Route::get('/ui/typography', function () {
        return view('ui.typography');
    })->name('ui.typography');

    // Forms
    Route::get('/forms/basic', function () {
        return view('forms.basic');
    })->name('forms.basic');

    // Tables
    Route::get('/tables/basic', function () {
        return view('tables.basic');
    })->name('tables.basic');

    // Charts
    Route::get('/charts/chartjs', function () {
        return view('charts.chartjs');
    })->name('charts.chartjs');

    // Icons
    Route::get('/icons/fontawesome', function () {
        return view('icons.fontawesome');
    })->name('icons.fontawesome');

    // Error pages
    Route::get('/errors/404', function () {
        return view('errors.404');
    })->name('errors.404');

    Route::get('/errors/500', function () {
        return view('errors.500');
    })->name('errors.500');

    // Pages
    Route::get('/pages/blank', function () {
        return view('pages.blank');
    })->name('pages.blank');

    // Documentation
    Route::get('/documentation', function () {
        return view('documentation');
    })->name('documentation');
});
