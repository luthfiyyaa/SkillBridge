<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $fillable = [
    'tanggal', 
    'topik', 
    'status', 
    'mentor_id',
    'kontak'
];
    public function feedbacks()
    {
    return $this->hasMany(Feedback::class);
    }
}
