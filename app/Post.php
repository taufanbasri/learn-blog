<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the Comment for the model.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
      // Bisa dengan cara ini yang simple
      $this->comments()->create(compact('body'));

      // merepresentasikan cara ini.

      // Comment::create([
      //   'body'  => request('body'),
      //   'post_id' => $this->id,
      // ]);
    }
}
