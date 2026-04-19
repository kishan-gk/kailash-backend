<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;

/*
|--------------------------------------------------------------------------
| Portfolio Public API
| Base URL: /api/portfolio
|
| Your React site fetch karegi in endpoints se.
| CORS already configured hai. Koi auth nahi chahiye frontend ke liye.
|--------------------------------------------------------------------------
*/

Route::prefix('portfolio')->group(function () {
    Route::get('/',           [PortfolioController::class, 'all']);        // ALL DATA
    Route::get('/hero',       [PortfolioController::class, 'hero']);
    Route::get('/nav',        [PortfolioController::class, 'nav']);
    Route::get('/marquee',    [PortfolioController::class, 'marquee']);
    Route::get('/projects',   [PortfolioController::class, 'projects']);
    Route::get('/skills',     [PortfolioController::class, 'skills']);
    Route::get('/tools',      [PortfolioController::class, 'tools']);
    Route::get('/experience', [PortfolioController::class, 'experience']);
    Route::get('/about',      [PortfolioController::class, 'about']);
});
