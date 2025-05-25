<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests'; // sama seperti CategoryTest

    protected $fillable = ['title', 'bidang', 'image', 'description'];

     public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
