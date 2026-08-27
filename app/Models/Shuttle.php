<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    protected $guarded = [];

    public function photos()  {
        return $this->hasMany(ShuttlePhoto::class);
    }
}
