<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;

final class UpdateOrganizationAction
{
    /**
     * Update an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $dto->organization->update([
                'name' => $dto->name,
            ]);

            return [
                'message' => 'Organisation mise à jour !',
                'organization' => $dto->organization,
            ];
        });
    }
}
