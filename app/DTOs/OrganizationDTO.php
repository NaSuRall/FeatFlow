<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Models\Organization;

final class OrganizationDTO
{
    private function __construct(
        public ?int $user_id,
        public ?string $name,
    ){}

    //DTO pour create
    public static function fromRequest(Request $request): self
    {
        return new self(
            user_id: $request->input('user_id'),
            name: $request->input('name'),
        );
    }

}
