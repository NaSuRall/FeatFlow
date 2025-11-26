<?php

namespace App\Actions\Member;

use App\DTOs\MemberDTO;
use Illuminate\Support\Facades\DB;

final class AddMemberAction
{
    public function handle(MemberDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $dto->organization->users()->attach($dto->userId, [
                'role' => $dto->role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });
    }
}
