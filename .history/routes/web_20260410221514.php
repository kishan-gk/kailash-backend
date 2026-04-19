<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\NavLinkController;
use App\Http\Controllers\Admin\MarqueeController;

// ── Admin Auth ────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Hero
        Route::get('/hero',  [HeroController::class, 'edit'])->name('hero.edit');
        Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');

        // About
        Route::get('/about',  [AboutController::class, 'edit'])->name('about.edit');
        Route::post('/about', [AboutController::class, 'update'])->name('about.update');

        // Projects
        Route::resource('projects', ProjectController::class)->except(['show']);
        Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');

        // Experience
        Route::resource('experience', ExperienceController::class)->except(['show']);

        // Skills
        Route::resource('skills', SkillController::class)->except(['show']);

        // Tools
        Route::resource('tools', ToolController::class)->except(['show']);

        // Nav Links
        Route::get('/nav',             [NavLinkController::class, 'index'])->name('nav.index');
        Route::post('/nav',            [NavLinkController::class, 'store'])->name('nav.store');
        Route::put('/nav/{nav}',       [NavLinkController::class, 'update'])->name('nav.update');
        Route::delete('/nav/{nav}',    [NavLinkController::class, 'destroy'])->name('nav.destroy');

        // Marquee
        Route::get('/marquee',             [MarqueeController::class, 'index'])->name('marquee.index');
        Route::post('/marquee',            [MarqueeController::class, 'store'])->name('marquee.store');
        Route::delete('/marquee/{marquee}',[MarqueeController::class, 'destroy'])->name('marquee.destroy');
    });
});

Route::get('/', fn() => redirect('/admin'));
