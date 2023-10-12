<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/open-ai-request', function () {
    return view('send-request');
});
Route::post('/send-request', [App\Http\Controllers\OpenAIController::class, 'sendRequest'])->name('send');
Route::get('/question-bank', [App\Http\Controllers\OpenAIController::class, 'getQuestions'])->name('list');
Route::post('/save-question', [App\Http\Controllers\OpenAIController::class, 'saveQuestions'])->name('save-question');
