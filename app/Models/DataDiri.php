<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'username',
        'email',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'institusi',
        'bidang_minat',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
