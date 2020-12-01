<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    protected CommentRepository $commentRepository;

    /**
     * DashboardController constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function show(): Response
    {
        return Inertia::render('Dashboard/Show', [
            'comments' => $this->commentRepository->getAll(),
        ]);
    }
}
