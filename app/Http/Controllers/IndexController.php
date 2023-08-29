<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct(
        private BlogPostRepository $blogPostRepository
    )
    {
    }

    public function index()
    {
        return view('index', [
            'posts' => $this->blogPostRepository->getAllWithPagination(10)
        ]);
    }
}
