<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentoringRequest extends Model
{
    use HasFactory;

    protected $table = 'mentoring_requests'; // nama tabel di database

    protected $fillable = [
        'mentor_id',
        'nama_pemohon',
        'email',
        'pesan',
    ];
    
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
