<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Models\Survey;
use App\Actions\Survey\StoreSurveyAnswerAction;
use App\DTOs\SurveyAnswerDTO;

class SurveyController extends Controller
{
    
    public function store(Request $request, StoreSurveyAnswerAction $action)
    {
       $dto = SurveyAnswerDTO::fromRequest($request);
       $articles = $action->execute($dto);

        return response()->json("Reponse Sauvegarder avec success !");
    }

    public function getForms(){

        $forms = Survey::with('questions')->get();
        return view('survey.surveyAnswer', compact('forms'));
    }
}
