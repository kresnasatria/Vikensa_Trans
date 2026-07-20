<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    // Memberi tahu Laravel bahwa 1 Booking terhubung ke 1 Jadwal (Schedule)
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}