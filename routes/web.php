<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {


    // Routes pour la gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour la gestion des organisations
    Route::get('/organization', [OrganizationController::class, 'index'])->name('organization.index');
    Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');
    Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store');
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy')->middleware(['auth']);
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update')->middleware(['auth']);

    // Routes pour la gestion des membres d'une organisation
    Route::post('/organizations/{organization}/members', [MemberController::class, 'addMember'])->name('organizations.members.add');
    Route::delete('/organizations/{organization}/members', [MemberController::class, 'deleteMember'])->name('organizations.members.delete');


});

// Routes pour la gestion des sondages
Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
Route::put('/survey/update/{survey}', [SurveyController::class, 'update'])->name('survey.update');
Route::delete('/survey/delete/{survey}', [SurveyController::class, 'delete'])->name('survey.delete');

// Route pour accéder à un sondage via son token
Route::get('/survey/{token}', [SurveyController::class, 'show'])->name('survey.show');


// Routes pour gérer les réponses aux sondages
Route::get('/survey/answer', [App\Http\Controllers\SurveyController::class, 'getForms'])->name('storeAnswer.show');
Route::post('/survey/answer', [App\Http\Controllers\SurveyController::class, 'storeAnswer'])->name('storeAnswer.store');

// Routes pour gérer les questions d'un sondage
Route::get('/question/{survey_id}', [App\Http\Controllers\SurveyController::class, 'indexQuestions'])->name('storeQuestion.show');
Route::post('/question', [App\Http\Controllers\SurveyController::class, 'storeQuestion'])->name('question.store');

require __DIR__.'/auth.php';
