<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

        protected  $question_body; 

        protected $fillable = [
                "question_body"
        ];

        
        public function poll() {
                return $this->belongsTo(\App\Models\Poll::class);
        }

        public function options() {
                return $this->hasMany(\App\Models\Option::class);
        } 

        
        public function answers() {
                return $this->hasMany(\App\Models\Answers::class);
        }

        

        
}
