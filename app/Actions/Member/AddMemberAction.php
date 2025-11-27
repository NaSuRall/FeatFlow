<?php

namespace App\Actions\Member;

use App\DTOs\MemberDTO;
use App\Models\OrganizationUser;


final class AddMemberAction
{
    public function execute(MemberDTO $dto): OrganizationUser{

        //create un survey in db
        $organizationUser = OrganizationUser::create([
            'organization_id' => $dto->organization_id,
            'user_id' => $dto->user_id,
            'role' => $dto->role,
        ]);

        return $organizationUser;
    }
}
