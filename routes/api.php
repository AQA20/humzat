<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;


Route::middleware(['api', 'throttle:api'])->group(function () {
    // ✅ Auth Public routes
    Route::post('/register', RegisterController::class)->middleware('throttle:register');
    Route::post('/login', LoginController::class)->middleware('throttle:login');


    // ✅ Public routes
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::post('posts/{post}/share', [PostController::class, 'share']);
    Route::apiResource('comments', CommentController::class)->only(['index', 'show']);
    Route::get('/media/{media}', [MediaController::class, 'show']);
    Route::apiResource('hashtags', HashtagController::class)->only(['index', 'show']);
    Route::get('/hashtags/by-name/{name}', [HashtagController::class, 'showByName']);
    // User Public routes
    Route::get('/users/{user}', [UserController::class, 'show'])->whereUuid('user');
    Route::get('/users/{user}/posts', [UserController::class, 'posts'])->whereUuid('user');
    Route::get('/users/{user}/comments', [UserController::class, 'comments'])->whereUuid('user');


    // ✅ Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', LogoutController::class);
        Route::get('/me', fn(Request $request) => new UserResource($request->user()));
        Route::apiResource('posts', PostController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('comments', CommentController::class)
            ->only(['store', 'update', 'destroy'])
            ->middleware('throttle:comment');
        // Media store and destroy routes explicitly
        Route::post('/media', [MediaController::class, 'store']);    // upload
        Route::delete('/media/{media}', [MediaController::class, 'destroy']);  // delete by id
        // Upload user profile picture
        Route::post('/users/profile-picture', [UserController::class, 'uploadProfilePicture']);
        // Block user
        Route::post('/users/{user}/block', [BlockController::class, 'store']);
        // Unblock user
        Route::delete('/users/{user}/block', [BlockController::class, 'destroy']);
        // Get blocked users
        Route::get('/users/blocked', [BlockController::class, 'index']);
    });
});
