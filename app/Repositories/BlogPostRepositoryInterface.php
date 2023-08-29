<?php

namespace App\Repositories;

use App\Models\BlogPost;

interface BlogPostRepositoryInterface
{
    public function getAllWithPagination(int $pageLength);
    public function findOrFail(int $id): BlogPost;
    public function createBlogPost(array $details): BlogPost;
    public function updateBlogPost(int $postId, array $newDetails): BlogPost;
    public function delete(int $id);
}