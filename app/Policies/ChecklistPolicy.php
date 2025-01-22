<?php

namespace App\Policies;

use App\Models\Checklist;
use App\Models\User;

class ChecklistPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Checklist $checklist)
    {
        return $user->id === $checklist->user_id;
    }
}
