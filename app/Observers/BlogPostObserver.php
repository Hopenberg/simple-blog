<?php

namespace App\Observers;

use App\Models\BlogPost;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     */
    public function creating(BlogPost $blogPost): void
    {
        $blogPost->created_by = auth()->user()->id;
        $blogPost->updated_by = auth()->user()->id;
    }

    /**
     * Handle the BlogPost "updated" event.
     */
    public function updating(BlogPost $blogPost): void
    {
        $blogPost->updated_by = auth()->user()->id;
    }
}
