<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;
    
    protected $table = 'postingan_';
    protected $fillable = [
        'user_id',
        'title',
        'summary',
        'content',
        'field',
    ];

    // Relasi ke user (penulis post)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
