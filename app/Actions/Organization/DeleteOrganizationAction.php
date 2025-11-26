<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;

final class DeleteOrganizationAction
{
    /**
     * Delete an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $dto->organization->delete();

            return [
                'message' => 'Organisation supprimée !',
                'organization_id' => $dto->organization->id,
            ];
        });
    }
}
