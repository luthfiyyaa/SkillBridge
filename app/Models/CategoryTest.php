<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTest extends Model
{
    protected $table = 'tests';
    protected $fillable = 
    ['title', 
    'bidang', 
    'image', 
    'description'];

    // app/Models/Test.php
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
