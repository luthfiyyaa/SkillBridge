<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['post_id', 'isi', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
