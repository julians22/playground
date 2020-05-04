<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    public function category()
    {
        return $this->belongsTo('App\PackageCategory');
    }
}
