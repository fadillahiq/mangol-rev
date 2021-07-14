<?php

use App\Http\Controllers\Admin\ComicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mangol\AllKomikController;
use App\Http\Controllers\Mangol\GenreController as MangolGenreController;
use App\Http\Controllers\Mangol\HomeController as MangolHomeController;
use App\Http\Controllers\Mangol\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MangolHomeController::class, 'index'])->name('mangol.home');
Route::get('/completed', [MangolHomeController::class, 'completed'])->name('mangol.completed');
Route::get('/genre', [MangolGenreController::class, 'index'])->name('mangol.genre');
Route::get('/all-komik', [AllKomikController::class, 'index'])->name('mangol.all.komik');
Route::get('/search-result', [SearchController::class, 'index'])->name('mangol.search');
Route::get('/genre/{slug}', [MangolGenreController::class, 'result_genre'])->name('mangol.genre.result');

Auth::routes([
    'register' => false
]);

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('komik', ComicController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('user', UserController::class);
});

Route::resource('chapter', ChapterController::class);

Route::middleware(['role:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


