<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\DTOs\SurveyAnswerDTO;
use App\Models\SurveyAnswer;
use Illuminate\Support\Facades\DB;

final class StoreSurveyAnswerAction
{
    public function __construct() {}

    /**
     * Store a Survey
     * @param SurveyDTO $dto
     * @return array
     */

    public function execute(SurveyAnswerDTO $dto): SurveyAnswer {
        

    $answeredQuestions = SurveyAnswer::create([
        'survey_id' => $dto->survey_id,
        'survey_question_id' => $dto->survey_question_id,
        'answer' => is_array($dto->answers) ? join(', ', $dto->answers) : $dto->answers,
        'user_id' => $dto->user_id,
    ]);    
    return $answeredQuestions;
    }
}
