<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('questions', QuestionController::class)->except('show');
Route::get('questions/{slug}', [QuestionController::class, 'show'])->name('questions.show');

Route::controller(AnswerController::class)->group(function () {
    Route::post('questions/{question}/answers', 'store')->name('answers.store');
    Route::get('/questions/{question}/answers/{answer}/edit', 'edit')->name('answers.edit');
    Route::put('/questions/{question}/answers/{answer}', 'update')->name('answers.update');
    Route::delete('/questions/{question}/answers/{answer}', 'destroy')->name('answers.destroy');
});

Route::post('answers/{answer}/accept', AcceptAnswerController::class)->name('answers.accept');

Route::controller(FavoritesController::class)->group(function () {
    Route::post('/questions/{question}/favorites', 'store')->name('questions.favorite');
    Route::delete('/questions/{question}/favorites', 'destroy')->name('questions.unfavorite');
});

Route::post('/questions/{question}/vote', VoteQuestionController::class);
Route::post('/answers/{answer}/vote', VoteAnswerController::class);



