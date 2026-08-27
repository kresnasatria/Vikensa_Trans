<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShuttlePhoto extends Model
{
    protected $guarded = [];

    public function shuttle() {
        return $this->belongsTo(Shuttle::class);
    }
}
