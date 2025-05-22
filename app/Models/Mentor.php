<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = ['nama', 'bidang', 'ketersediaan', 'foto', 'rating'];

}
