<?php

namespace App\Http\Controllers;

use App\Actions\Survey\CloseSurveyAction;
use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\StoreSurveyQuestionAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\SurveyDTO;
use App\DTOs\SurveyQuestionDTO;
use App\Http\Requests\Survey\DeleteSurveyRequest;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Organization;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Actions\Survey\StoreSurveyAnswerAction;
use App\DTOs\SurveyAnswerDTO;

class SurveyController extends Controller
{
    //test

    public function index(Organization $organization){

        session(['organization_id' => $organization->id]);

        $surveys = Survey::where('organization_id' , session('organization_id'))->get();
        return view('surveyForm', compact('surveys'));
    }
    public function store(StoreSurveyRequest $request, StoreSurveyAction $survey,){
        $dto = SurveyDTO::fromRequest($request);
        $data = $survey->execute($dto);
        return redirect()->route('survey.index',);
    }
// UpdateSurveyRequest
    public function update(UpdateSurveyRequest $request, UpdateSurveyAction $action, Survey $survey)
    {
        $dto = SurveyDTO::fromRequest($request, $survey);
        $data = $action->execute($dto, $survey);

        return redirect()->route('survey.index')
            ->with('success', 'Sondage mis à jour avec succès');
    }

    public function delete(DeleteSurveyRequest $request, Survey $survey, CloseSurveyAction $action)
    {
        $action->execute($survey);
        return redirect()->back();
    }


    public function storeAnswer(Request $request, StoreSurveyAnswerAction $action)
    {
       $dto = SurveyAnswerDTO::fromRequest($request);
       $articles = $action->execute($dto);

        return response()->json("Reponse Sauvegarder avec success !");
    }

    public function getForms(){

        $forms = Survey::with('questions')->get();
        return view('survey.surveyAnswer', compact('forms'));
    }

    public function indexQuestions($survey_id){
        $survey = Survey::where('user_id', auth()->id())->get();
        return view('questionForm', compact('survey', 'survey_id'));
    }

    public function storeQuestion(Request $request, StoreSurveyQuestionAction $action){
        $dto = SurveyQuestionDTO::fromRequest($request);
        $data = $action->execute($dto);

        return view('questionForm');
    }
}
