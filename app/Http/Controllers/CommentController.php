<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected CommentRepository $repository;

    /**
     * CommentController constructor.
     * @param CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CommentRequest $request)
    {
        $this->repository->store($request->user(), $request->validated());

        return redirect('/dashboard')->with('status', 'comment-stored');
    }

    public function destroy(Comment $comment)
    {
        $this->repository->delete($comment);

        return redirect('/dashboard')->with('status', 'comment-destroyed');
    }
}
