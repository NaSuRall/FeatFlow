<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class SurveyDTO
{
    private function __construct(
        public string $organization_id,
        public int $user_id,
        public string $title,
        public string $description,
        public string $start_date,
        public string $end_date,
        public bool $is_anonymous,

    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            organization_id: $request->input('organization_id', $survey?->organization_id),
            user_id: $request->user()->id,
            title: $request->input('title', $survey?->title),
            description: $request->input('description', $survey?->description),
            start_date: $request->input('start_date', $survey?->start_date),
            end_date: $request->input('end_date', $survey?->end_date),
            is_anonymous: (bool) $request->input('is_anonymous', $survey?->is_anonymous)

        );
    }
}
