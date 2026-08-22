<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    use HasFactory;

    protected $guarded = []; // Mengizinkan semua kolom diisi

    // Relasi: Setiap catatan servis milik 1 armada (shuttle)
    public function shuttle()
    {
        return $this->belongsTo(Shuttle::class);
    }
}