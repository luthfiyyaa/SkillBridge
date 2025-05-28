<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatMentoring;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $fillable = [
    'user_id',
    'tanggal', 
    'topik', 
    'status', 
    'mentor_id'
];
    public function feedbacks()
    {
    return $this->hasMany(RiwayatMentoring::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
