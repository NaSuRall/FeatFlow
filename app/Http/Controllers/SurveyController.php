<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use Illuminate\Support\Carbon;

class SurveyController extends Controller
{
    public function show(string $token)
    {
        $survey = (object) [
            'title' => 'Titre du sondage',
            'description' => 'Description du sondage',
        ];

        return view('survey.show', compact('survey'));
    }
}
