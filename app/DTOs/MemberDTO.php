<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Http\Requests\Member\AddMemberRequest; 
use App\Http\Requests\Member\DeleteMemberRequest;  

final class MemberDTO
{
    public int $userId;
    public Organization $organization;
    public string $role;

    private function __construct(int $userId, Organization $organization, string $role)
    {
        $this->userId = $userId;
        $this->organization = $organization;
        $this->role = $role;
    }

    // Ajouter un membre
    public static function fromAddRequest(AddMemberRequest $request, Organization $organization): self
    {
        return new self(
            $request->input('user_id'),
            $organization,
            'member'
        );
    }

    // Supprimer un membre
    public static function fromDeleteRequest(DeleteMemberRequest $request, Organization $organization): self
    {
        return new self(
            $request->input('user_id'),
            $organization,
            'admin'
        );
    }

    // Donne le rôle admin au propriétaire de l'organisation
    public static function forOwner(Organization $organization, int $userId): self
    {
        return new self(
            $userId,
            $organization,
            'admin'
        );
    }
}
