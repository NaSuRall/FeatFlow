<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Models\Organization;

final class OrganizationDTO
{
    public ?string $name;
    public int $userId;
    public ?Organization $organization;


    private function __construct(?string $name, int $userId, ?Organization $organization = null)
    {
        $this->name = $name;
        $this->userId = $userId;
        $this->organization = $organization;
    }

    //DTO pour create
    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->user()->id
        );
    }

    //DTO pour delete
    public static function fromOrganization(Organization $organization, int $userId): self
    {
        return new self(
            name: null,
            userId: $userId,
            organization: $organization
        );
    }

    //DTO pour udpdate
    public static function fromUpdateRequest(Request $request, Organization $organization): self
    {
        return new self(
            $request->input('name'),
            $request->user()->id,
            $organization
        );
    }
}