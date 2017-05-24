<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
      return $this->belongsTo('App\Post');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function likes()
    {
      return $this->hasMany('App\Like','post_or_comment_id');
    }

    public function reports()
    {
      return $this->hasMany('App\Report');
    }
}
