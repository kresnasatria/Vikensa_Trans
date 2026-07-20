<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];

    // Memberi tahu bahwa 1 Jadwal dimiliki oleh 1 Rute
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    // Memberi tahu bahwa 1 Jadwal menggunakan 1 Armada (Shuttle)
    public function shuttle()
    {
        return $this->belongsTo(Shuttle::class);
    }
}