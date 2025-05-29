<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatMentoring extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['user_id', 'jadwal_id', 'rating', 'komentar'];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }


}
