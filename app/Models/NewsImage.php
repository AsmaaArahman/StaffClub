<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    use HasFactory;
        
        protected $image;
        protected $featured;
        
        public function news() {
                return $this->belongsTo(\App\Models\News::class);
        }

}
