<?php

namespace App\Policies;

use App\Models\CD;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CDPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given CD can be viewed by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CD  $cd
     * @return bool
     */
    public function view(User $user, CD $cd)
    {
        return $user->cd_id === $cd->id;
    }
}
