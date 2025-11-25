<?php

namespace App\Http\Controllers;

use App\Actions\Organization\StoreOrganizationAction;
use App\DTOs\OrganizationDTO;
use App\Http\Requests\Organization\StoreOrganizationRequest;

class OrganizationController extends Controller
{
    public function store(StoreOrganizationRequest $request, StoreOrganizationAction $action)
    {
        $dto = OrganizationDTO::fromRequest($request);

        $organization = $action->handle($dto);

        return response()->json([
            'message' => 'Organisation créée avec succès',
            'organization' => $organization
        ], 201);
    }
}
