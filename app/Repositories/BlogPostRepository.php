<?php

namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class BlogPostRepository implements BlogPostRepositoryInterface
{
    public function getAllWithPagination(int $pageLength): LengthAwarePaginator
    {
        return BlogPost::paginate($pageLength);
    }

    public function findOrFail(int $id): BlogPost
    {
        return BlogPost::findOrFail($id);
    }

    public function createBlogPost(array $details): BlogPost
    {
        $post = new BlogPost();
        $post->title = $details['title'];
        $post->content = $details['content'];
        $post->cover = $details['cover'];

        $post->save();

        return $post;
    }

    public function updateBlogPost(int $postId, array $newDetails): BlogPost
    {
        $post = BlogPost::findOrFail($postId);

        $post->title = $newDetails['title'];
        $post->content = $newDetails['content'];

        if (!empty($newDetails['cover']))
        {
            $post->cover = $newDetails['cover'];
        }

        $post->save();

        return $post;
    }

    public function delete(int $id)
    {
        $post = BlogPost::find($id);

        return $post->delete();
    }
}