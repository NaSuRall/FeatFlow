<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
Route::put('/survey/update/{survey}', [SurveyController::class, 'update'])->name('survey.update');
Route::delete('/survey/delete/{survey}', [SurveyController::class, 'delete'])->name('survey.delete');


Route::get('/survey/answer', [App\Http\Controllers\SurveyController::class, 'getForms'])->name('storeAnswer.show');
Route::post('/survey/answer', [App\Http\Controllers\SurveyController::class, 'storeAnswer'])->name('storeAnswer.store');

Route::get('/question/{survey_id}', [App\Http\Controllers\SurveyController::class, 'indexQuestions'])->name('storeQuestion.show');
Route::post('/question', [App\Http\Controllers\SurveyController::class, 'storeQuestion'])->name('question.store');

require __DIR__.'/auth.php';
