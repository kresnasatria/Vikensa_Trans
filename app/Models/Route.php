<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $guarded = [];

    // Hubungan ke tabel lokasi sebagai Titik Asal
    public function origin()
    {
        return $this->belongsTo(Location::class, 'origin_id');
    }

    // Hubungan ke tabel lokasi sebagai Titik Tujuan
    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }
}