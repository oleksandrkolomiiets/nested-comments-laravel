<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Comment $comment
     * @return bool
     */
    public function destroy(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id;
    }
}
