<?php

namespace App\DTOs;

use App\Models\Survey;
use Illuminate\Http\Request;

final class SurveyDTO
{
    private function __construct(
        public ?string $organization_id,
        public int $user_id,
        public ?string $title,
        public ?string $description,
        public ?string $start_date,
        public ?string $end_date,
        public ?bool $is_anonymous,

    ) {}

    public static function fromRequest(Request $request, ?Survey $survey = null): self
    {
        return new self(
            organization_id: 1,
            user_id: $request->user()->id,
            title: $request->input('title', $survey?->title),
            description: $request->input('description', $survey?->description),
            start_date: $request->input('start_date', $survey?->start_date),
            end_date: $request->input('end_date', $survey?->end_date),
            is_anonymous: $request->has('is_anonymous')
                ? (bool) $request->input('is_anonymous')
                : null
        );
    }
}
