<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class OrganizationDTO
{
    public string $name;
    public int $userId;


    private function __construct(string $name, int $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->user()->id
        );
    }
}
