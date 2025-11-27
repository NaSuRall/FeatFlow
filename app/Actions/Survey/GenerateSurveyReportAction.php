<?php

namespace App\Actions\Survey;

use App\Models\Survey;
use App\DTOs\SurveyReportDTO;

class GenerateSurveyReportAction
{
    public function execute(Survey $survey): array
    {
        $survey->load('questions.answers');

        $report = [];

        foreach ($survey->questions as $question) {
            $answers = $question->answers->pluck('answer')->toArray();

            $counts = array_count_values($answers);

            $labels = array_keys($counts);
            $data   = array_values($counts);

            $report[] = SurveyReportDTO::fromSurveyData($question->title, $labels, $data);
        }

        return $report;
    }
}
