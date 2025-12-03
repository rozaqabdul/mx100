<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Api\V1\Freelancer\JobController as FreelancerJobController;
use App\Http\Controllers\Api\V1\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        // Employer
        Route::prefix('employer')->middleware('role:employer')->group(function () {
            Route::apiResource('jobs', EmployerJobController::class)->except(['destroy']);
            Route::get('jobs/{job}/applications', [ApplicationController::class, 'index']);
        });

        // Freelancer
        Route::prefix('freelancer')->middleware('role:freelancer')->group(function () {
            Route::get('jobs', [FreelancerJobController::class, 'index']);
            Route::get('jobs/{job}', [FreelancerJobController::class, 'show']);
            Route::post('jobs/{job}/apply', [ApplicationController::class, 'store']);
        });
    });
});
