<?php

namespace App;

class Comment extends Model
{
    /**
     * Get the post that owns the model.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
