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

    // public function show($id)
    // {
    //     // Récupère l'organisation
    //     $organization = Organization::findOrFail($id);

    //     // Récupère uniquement les users dont la table pivot a organization_id = $organization->id
    //     $users = $organization->users()->wherePivot('organization_id', $organization->id)->get();

    //     return view('organization', compact('organization', 'users'));
    // }

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

        $organization = $action->handle($dto);

        return redirect()->route('organization.index');
    }

    //Supprimer une organization
    public function destroy(DeleteOrganizationRequest $request, Organization $organization, DeleteOrganizationAction $action)
    {
        $dto = OrganizationDTO::fromOrganization($organization, $request->user()->id);

        $result = $action->handle($dto);

        return redirect()->route('organization.index');
    }

    //Mettre a jour une organization
    public function update(UpdateOrganizationRequest $request, Organization $organization, UpdateOrganizationAction $action)
    {
        $dto = OrganizationDTO::fromUpdateRequest($request, $organization);

        $result = $action->handle($dto);

        return redirect()->route('organization.index');
    }
}
