<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function category()
    {
      return $this->hasOne('App\Category');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment','user_id','user_id');
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
