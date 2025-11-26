<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\DTOs\SurveyQuestionDTO;
use App\Models\SurveyQuestion;
use Illuminate\Support\Facades\DB;

final class StoreSurveyQuestionAction
{
    public function __construct(

        // ?
    ) {}

    /**
     * Store a Survey
     * @param SurveyDTO $dto
     * @return array
     */
    public function execute(SurveyQuestionDTO $dto): SurveyQuestion
    {
        $question = SurveyQuestion::create([
            'survey_id' => $dto->survey_id,
            'title' => $dto->title,
            'question_type'=>$dto->question_type,
            'options' => json_encode($dto->options)
        ]);
        return $question;
    }
}
