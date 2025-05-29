<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lamaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'user_id',
        'email',
        'telepon',
        'pengalaman',
        'alasan',
        'file_portofolio',
        'lowongan_id',
        'status'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
