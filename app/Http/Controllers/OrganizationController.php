<?php

namespace App\Http\Controllers;

use App\Actions\Organization\StoreOrganizationAction;
use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use App\Actions\Organization\DeleteOrganizationAction;
use App\Http\Requests\Organization\DeleteOrganizationRequest;
use App\Actions\Organization\UpdateOrganizationAction;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Models\User;

class OrganizationController extends Controller
{
    //Afficher les organization du user
    public function index()
    {
        $organizations = Organization::where('user_id', auth()->id())->get();
        $users = User::all();

        return view('organization', compact('organizations', 'users'));
    }

    //Créer une organization
    public function store(StoreOrganizationRequest $request, StoreOrganizationAction $action)
    {
        $dto = OrganizationDTO::fromRequest($request);
        $organization = $action->execute($dto);

        return redirect()->route('organization.index');
    }

    //Supprimer une organization
    public function destroy(DeleteOrganizationRequest $request, Organization $organization, DeleteOrganizationAction $action)
{
        $dto = OrganizationDTO::fromRequest($request);

        $action->handle($dto, $organization->id);

        return redirect()->route('organization.index');
    }

    //Mettre a jour une organization
    public function update(UpdateOrganizationRequest $request, Organization $organization, UpdateOrganizationAction $action)
    {
        $dto = OrganizationDTO::fromRequest($request);

        $action->handle($dto, $organization->id);

        return redirect()->route('organization.index');
    }
}
