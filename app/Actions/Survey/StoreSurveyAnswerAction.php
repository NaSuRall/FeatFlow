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

    public function execute(SurveyAnswerDTO $dto): array
    {
        $answeredQuestions = [];

        // On boucle sur chaque question_id
        foreach ($dto->survey_question_id as $questionId) {
            // On récupère la réponse correspondante par clé
            $answer = $dto->answers[$questionId] ?? null;

            $surveyAnswer = SurveyAnswer::create([
                'survey_id'          => $dto->survey_id,
                'survey_question_id' => $questionId,
                'answer'             => is_array($answer) ? join(', ', $answer) : $answer,
                'user_id'            => $dto->user_id,
            ]);

            event(new \App\Events\SurveyAnswerSubmitted($surveyAnswer));

            $answeredQuestions[] = $surveyAnswer;
        }


        return $answeredQuestions;
    }
}
