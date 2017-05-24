<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function post()
  {
    return $this->belongsTo('App\Post','post_or_comment_id');
  }

  public function comment()
  {
    return $this->belongsTo('App\Comment','post_or_comment_id');
  }
}
