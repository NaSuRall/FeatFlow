<?php

namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

final class StoreOrganizationAction
{
     /**
     * Store an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $organization = Organization::create([
                'name' => $dto->name,
                'user_id' => $dto->userId,
            ]);

            $organization->users()->attach($dto->userId, [
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            return [
                'organization' => $organization,
                'message' => 'Organisation créée !',
            ];
        });
    }
}
