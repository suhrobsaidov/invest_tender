<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnouncementsPolicy
{
    use HandlesAuthorization;

    // /**
    //  * Create a new policy instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }
    public function before(User $user)
    {
        if( $user->role =='anouncer')
        {
            return true;
        };
    }
}
