<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;

final class DeleteOrganizationAction
{

    public function handle(OrganizationDTO $dto, int $organizationId): array
    {
        return DB::transaction(function () use ($organizationId) {

            $organization = Organization::findOrFail($organizationId);

            $id = $organization->id;
            $organization->delete();

            return [
                'organization_id' => $id,
                'message' => 'Organisation supprimée !',
            ];
        });
    }
}
