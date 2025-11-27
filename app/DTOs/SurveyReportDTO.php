<?php

namespace App\DTOs;

final class SurveyReportDTO
{
    private function __construct(
        public string $question,
        public array $labels,
        public array $data,
    ) {}

    public static function fromSurveyData(string $question, array $labels, array $data): self
    {
        return new self($question, $labels, $data);
    }
}
