<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    public function getAll(): Collection
    {
        return Comment::query()->whereNull('comment_id')
            ->with('comments')
            ->orderByDesc('id')
            ->get();
    }

    public function store(User $user, array $data)
    {
        return $user->comments()->create($data);
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }
}
