<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General_Settings extends Model
{
    public function msg()
    {
      return $this->hasOne('App\Message','id');
    }
}
