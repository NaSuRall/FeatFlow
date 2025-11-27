<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Http\Requests\Member\AddMemberRequest;
use App\Http\Requests\Member\DeleteMemberRequest;

final class MemberDTO
{
    private function __construct(
        public int $user_id,
        public int $organization_id,
        public string $role,
    )
    {}

    // Ajouter un membre
    public static function fromRequest(Request $request): self
    {
        return new self(
            user_id: $request->input('user_id'),
            organization_id: $request->input('organization_id'),
            role: $request->input('role'),
        );
    }
}
