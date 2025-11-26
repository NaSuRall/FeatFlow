<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\DTOs\MemberDTO;
use App\Http\Requests\Member\AddMemberRequest;
use App\Http\Requests\Member\DeleteMemberRequest;
use App\Actions\Member\AddMemberAction;
use App\Actions\Member\DeleteMemberAction;

class MemberController extends Controller
{
    public function addMember(AddMemberRequest $request, Organization $organization, AddMemberAction $action)
    {
        $dto = MemberDTO::fromAddRequest($request, $organization);
        $action->handle($dto);

        return redirect()->route('dashboard');
    }

    public function deleteMember(DeleteMemberRequest $request, Organization $organization, DeleteMemberAction $action)
    {
        $dto = MemberDTO::fromDeleteRequest($request, $organization);
        $action->handle($dto);

        return redirect()->route('dashboard');
    }
}
