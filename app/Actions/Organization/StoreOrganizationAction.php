<?php

namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

final class StoreOrganizationAction
{
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $organization = Organization::create([
                'name' => $dto->name,
                'user_id' => $dto->userId,
            ]);

            return [
                'organization' => $organization,
                'message' => 'Organisation créée avec succès',
            ];
        });
    }
}
