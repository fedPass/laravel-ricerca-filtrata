<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function options(){
      return $this->belongsToMany('App\Option');
    }
}
