<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function General_Settings()
    {
      return $this->belongsTo('App\General_Settings');
    }
    
}
