<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPostRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Repositories\BlogPostRepositoryInterface;

class AdminPanelBlogPostController extends Controller
{
    public function __construct(
        private BlogPostRepositoryInterface $blogPostRepository
    )
    {
    }

    public function index()
    {
        return view('admin-panel.posts.index', [
            'posts' => $this->blogPostRepository->getAllWithPagination(10),
            'status' => Session::get('status')
        ]);
    }

    public function create()
    {
        return view('admin-panel.posts.createOrEdit', [
            'post' => new BlogPost()
        ]);
    }

    public function store(StoreBlogPostRequest $request)
    {
        $validated = $request->validated();
        
        $path = $request->file('cover')->store('covers');
        
        $this->blogPostRepository->createBlogPost([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'cover' => $path
        ]);

        return redirect('/admin-panel/posts')->with('status', 'Post was created.');
    }

    public function edit(int $id)
    {
        return view('admin-panel.posts.createOrEdit', [
            'post' => $this->blogPostRepository->findOrFail($id)
        ]);
    }

    public function update(UpdateBlogPostRequest $request, int $id)
    {
        $newData = $request->safe()->only('title', 'content');

        if ($request->file('cover') !== null && $request->file('cover')->getError() !== 1)
        {
            $post = BlogPost::findOrFail($id);
            if (!empty($post->cover))
            {
                Storage::delete($post->cover);
            }

            $newData['cover'] = $request->file('cover')->store('covers');
        }

        $this->blogPostRepository->updateBlogPost($id, $newData);

        return redirect('/admin-panel/posts')->with('status', 'Post was updated.');
    }

    public function destroy(int $id)
    {
        $post = BlogPost::findOrFail($id);

        $post->delete();

        return redirect('/admin-panel/posts')->with('status', 'Post was deleted.');
    }
}
