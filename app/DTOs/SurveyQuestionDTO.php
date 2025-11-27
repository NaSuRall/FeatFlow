<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class SurveyQuestionDTO
{
    private function __construct(
        public int $survey_id,
        public string $title,
        public string $question_type,
        public ?array $options,
    ) {}

    public static function fromRequest(Request $request, ): self
    {
        return new self(
            survey_id: $request->input ('survey_id'),
            title: $request->input('title'),
            question_type: $request->input('question_type'),
            options: $request->input('options')
        );
    }
}
