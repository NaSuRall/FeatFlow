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
    public function execute(OrganizationDTO $dto): array
    {
        $organization = Organization::create([
            'name' => $dto->name,
            'user_id' => $dto->user_id,
        ]);

        $organization->users()->attach($dto->user_id, [
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return [
            'organization' => $organization,
            'message' => 'Organisation créée !',
        ];
    }

}
