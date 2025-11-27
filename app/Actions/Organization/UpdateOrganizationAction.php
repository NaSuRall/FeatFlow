<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;

final class UpdateOrganizationAction
{
    public function handle(OrganizationDTO $dto, int $organizationId): array
    {
        return DB::transaction(function () use ($dto, $organizationId) {

            $organization = Organization::findOrFail($organizationId);

            $organization->update([
                'name' => $dto->name,
            ]);

            return [
                'organization' => $organization,
                'message' => 'Organisation mise à jour !',
            ];
        });
    }
}
