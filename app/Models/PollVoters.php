<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVoters extends Model
{
    use HasFactory;


        public function member() {
                return $this->belongsTo(\App\Models\Member::class);
        } 


        
        public function poll() {
                return $this->belongsTo(\App\Models\Poll::class);
        } 
}
