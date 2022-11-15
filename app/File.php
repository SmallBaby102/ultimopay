<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function file_details()
    {
      return $this->hasMany('App\FileDetail');
    }
}
