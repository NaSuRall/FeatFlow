<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMemberRequest;
use App\Models\Organization;
use App\DTOs\MemberDTO;
use App\Http\Requests\Member\AddMemberRequest;
use App\Actions\Member\AddMemberAction;
use App\Actions\Member\DeleteMemberAction;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function addMember(Request $request, AddMemberAction $action)
    {
        $dto = MemberDTO::fromRequest($request);
        $action->execute($dto);
        return redirect()->back();
    }

    public function showMember(Organization $organization){

        $usersMember = OrganizationUser::where('organization_id', $organization->id)
            ->get();

        $users = User::whereNotIn('id', $usersMember->pluck('user_id'))->get();
        return view('members.show', compact('organization', 'users', 'usersMember'));
    }

    public function deleteMember(DeleteMemberRequest $request, Organization $organization, DeleteMemberAction $action)
    {
        $dto = MemberDTO::fromDeleteRequest($request, $organization);
        $action->handle($dto);

        return redirect()->route('dashboard');
    }
}
