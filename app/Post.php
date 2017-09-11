<?php

namespace App;
use Carbon\Carbon;

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

    /**
     * Scope a query to only include description.
     */
    public function scopeFilter($query, $filters)
    {
      if ($month = $filters['month']) {
        $query->whereMonth('created_at', Carbon::parse($month)->month);
      }

      if ($year = $filters['year']) {
        $query->whereYear('created_at', $year);
      }
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
