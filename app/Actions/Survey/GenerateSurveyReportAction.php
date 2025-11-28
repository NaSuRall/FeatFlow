<?php

namespace App\Actions\Survey;

use App\Models\Survey;
use App\DTOs\SurveyReportDTO;
use App\Models\User;

class GenerateSurveyReportAction
{
    public function execute(Survey $survey): array
    {
        $survey->load([
            'questions.answers',
            'answers.user:id,first_name,last_name,email'
        ]);

        $report = [];

        foreach ($survey->questions as $question) {
            $answers = $question->answers->pluck('answer')->toArray();

            $counts = array_count_values($answers);

            $labels = array_keys($counts);
            $data   = array_values($counts);

            $report[] = SurveyReportDTO::fromSurveyData($question->title, $labels, $data);
        }

        if ($survey->is_anonymous) {
            $participants = ['Sondage anonyme'];
        } else {
            $participants = $survey->answers
                ->pluck('user')
                ->unique('id')
                ->map(fn($u) => $u->first_name.' '.$u->last_name.' ('.$u->email.')')
                ->values()
                ->toArray();
        }

        return [
            'report'       => $report,
            'participants' => $participants,
        ];
    }
}
