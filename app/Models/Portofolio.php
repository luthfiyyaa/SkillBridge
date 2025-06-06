<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'telepon',
        'bidang',
        'deskripsi',
        'cv',
        'porto',
        'sertifikat',
        'linkedin',
    ];

    // Relasi ke User (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
