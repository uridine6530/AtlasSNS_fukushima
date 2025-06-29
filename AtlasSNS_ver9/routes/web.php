<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';
Route::group(['middleware' => 'auth'], function () {
  Route::get('top', [PostsController::class, 'index']);
  Route::post('post', [PostsController::class, 'post_create']);
  Route::post('/update{id}', [PostsController::class, 'update'])->name('update');
  Route::post('/delete{id}', [PostsController::class, 'delete'])->name('delete');

  Route::get('profile', [ProfileController::class, 'profile']);
  Route::post('profile-update', [ProfileController::class, 'update']);
  Route::get('profile{id}', [ProfileController::class, 'otherProfile'])->name('other');

  Route::post('search', [UsersController::class, 'search']);
  Route::get('search', [UsersController::class, 'search']);

  Route::get('follow-list', [FollowsController::class, 'followList']);
  Route::get('follower-list', [FollowsController::class, 'followerList']);

  Route::post('/follow{id}', [FollowsController::class, 'follow'])->name('follow');
  Route::post('/unfollow{id}', [FollowsController::class, 'unfollow'])->name('unfollow');

  Route::get('logout', [AuthenticatedSessionController::class, 'logout']);
});
