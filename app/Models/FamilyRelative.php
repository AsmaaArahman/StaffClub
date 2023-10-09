<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyRelative extends Model
{
    use HasFactory;

        protected $nat_id; 
        protected $pic ;
        protected $fullname;

        // protected $fillable= 

        public function kinship()
        {
                return $this->belongsTo(Kinship::class);
        }

        
        public function member()
        {
                return $this->belongsTo(Member::class);
        }
        
}
