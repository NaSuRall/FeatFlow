<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function index(){
        $surveys = Survey::where('user_id', auth()->id())->get();
        return view('surveyForm', compact('surveys'));
    }
    public function store(StoreSurveyRequest $request, StoreSurveyAction $survey){
        $dto = SurveyDTO::fromRequest($request);
        $data = $survey->execute($dto);
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ], 202);
    }

    public function update(UpdateSurveyRequest $request, UpdateSurveyAction $action, Survey $survey){
        //policies
        $dto = SurveyDTO::fromRequest($request);
        $data = $action->execute($dto, $survey);
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
