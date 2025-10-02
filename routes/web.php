<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FeedController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{projectId}', [ProjectController::class, 'show'])->name('project.show');
Route::get('/feed', [FeedController::class, 'index'])->name('feed');
Route::get('/feed/refresh', [FeedController::class, 'refresh'])->name('feed.refresh');
Route::get('/feed/debug', [FeedController::class, 'debug'])->name('feed.debug');
