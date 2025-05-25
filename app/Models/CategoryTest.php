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


}
