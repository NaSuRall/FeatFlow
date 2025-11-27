<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class SurveyAnswerDTO
{
    private function __construct(
        public int $survey_id,
        public array $answers,
        public array $survey_question_id,
        public ?int $user_id = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            survey_id: $request->input('survey_id'),
            answers: $request->input('answers', []),
            survey_question_id: $request->input('survey_question_id', []),
            user_id: $request->input('user_id'),
        );
    }
}
