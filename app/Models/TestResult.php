<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
     protected $fillable = ['user_id', 'test_id', 'score'];

     public function test()
     {
          return $this->belongsTo(Test::class);
     }

}
