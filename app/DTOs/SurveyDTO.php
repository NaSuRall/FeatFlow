<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class SurveyDTO
{
    public function __construct(
        public string $organization_id,
        public string $token,
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
           organization_id: $request -> organization_id,
           token: $request -> token,   
           user_id: $request->user()->id,
           title: $request-> title,
           description: $request-> description,
           start_date: $request-> start_date,
           end_date: $request-> end_start,
           is_anonymous: $request -> is_anonymous
        );
    }
}