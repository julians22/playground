<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    //
    public function package()
    {
        return $this->hasMany('App\Package');
    }
}
