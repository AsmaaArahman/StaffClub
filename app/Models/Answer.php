<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
        use HasFactory;

        
        
        public function member() {
                return $this->belongsTo(\App\Models\Member::class);
        } 
        
        public function question() {
                return $this->belongsTo(\App\Models\Question::class);
        } 
        
        public function option() {
                return $this->belongsTo(\App\Models\Option::class);
        } 

        
}
