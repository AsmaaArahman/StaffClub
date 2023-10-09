<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

        protected $title;
        protected $content;
        protected $active;
        
        
        public function mod() {
                return $this->belongsTo(\App\Models\Mod::class);
        }

        public function news_images() {
                return $this->hasMany(\App\Models\NewsImage::class);
        }
}
