<?php

namespace App\Actions\Member;

use App\DTOs\MemberDTO;

final class DeleteMemberAction
{
    public function handle(MemberDTO $dto): void
    {
        $dto->organization->members()->detach($dto->userId);
    }
}
