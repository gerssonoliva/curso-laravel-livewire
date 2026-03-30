<?php

namespace App\Observers;
use App\Models\Post;

class PostObserver
{
    public function updating(Post $post)
    {
        if ($post->is_published == 1 && !$post->published_at) {
            $post->published_at = now();
        }
    }
}
