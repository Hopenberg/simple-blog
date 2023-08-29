<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function show(int $id)
    {
        $post = BlogPost::findOrFail($id);
        
        return view('posts.show', ['post' => $post]);
    }
}
