<?php

namespace App\Http\Controllers;

use App\Actions\Survey\CloseSurveyAction;
use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\StoreSurveyQuestionAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\SurveyDTO;
use App\DTOs\SurveyQuestionDTO;
use App\Http\Requests\Survey\DeleteSurveyRequest;
use App\Http\Requests\Survey\StoreSurveyAnswerRequest;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Organization;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Actions\Survey\StoreSurveyAnswerAction;
use App\DTOs\SurveyAnswerDTO;
use Illuminate\Support\Carbon;

class SurveyController extends Controller
{

    //show the survey creation page with the associated organization in url
    public function index(Organization $organization){

        session(['organization_id' => $organization->id]);

        $surveys = Survey::where('organization_id' , session('organization_id'))->get();
        return view('surveyForm', compact('surveys'));
    }

    //create the survey in the database with the generated token
    public function store(StoreSurveyRequest $request, StoreSurveyAction $survey){
        $dto = SurveyDTO::fromRequest($request);
        $data = $survey->execute($dto);

        $publicLink = url("/survey/answer/{$data->token}");

        return redirect()->route('survey.index',session('organization_id'))
        ->with('success', 'Sondage créé avec succès')
        ->with('public_link', $publicLink);
    }

    //update a survey
    public function update(UpdateSurveyRequest $request, UpdateSurveyAction $action, Survey $survey)
    {
        $dto = SurveyDTO::fromRequest($request, $survey);
        $data = $action->execute($dto, $survey);

        return redirect()->route('survey.index',session('organization_id'))
            ->with('success', 'Sondage mis à jour avec succès');
    }

    //delete a survey
    public function delete(DeleteSurveyRequest $request, Survey $survey, CloseSurveyAction $action)
    {
        $action->execute($survey);
        return redirect()->back();
    }


    //save a response
    public function storeAnswer(StoreSurveyAnswerRequest $request, StoreSurveyAnswerAction $action)
    {
       $dto = SurveyAnswerDTO::fromRequest($request);
       $articles = $action->execute($dto);

        return response()->json("Reponse Sauvegarder avec success !");
    }


    //show answers so the user can respond to them
    public function getForms($token)
    {
        //retrieve the survey by token
        $survey = Survey::where('token', $token)
            ->with('questions')
            ->firstOrFail();

        return view('survey.surveyAnswer', [
            'surveys' => [$survey]
        ]);
    }

    //show survey to add questions
    public function indexQuestions($survey_id){
        $survey = Survey::where('user_id', auth()->id())->get();
        return view('questionForm', compact('survey', 'survey_id'));
    }

    // add question
    public function storeQuestion(Request $request, StoreSurveyQuestionAction $action){
        $dto = SurveyQuestionDTO::fromRequest($request);
        $data = $action->execute($dto);

        return view('questionForm');
    }
}
