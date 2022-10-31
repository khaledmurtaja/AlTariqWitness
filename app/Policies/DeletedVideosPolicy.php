<?php

namespace App\Policies;

use App\Models\DeletedVideos;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeletedVideosPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
     /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
//
    }

    public function view(User $user, DeletedVideos $deletedVideos)
    {
        return true;
    }

   
}
