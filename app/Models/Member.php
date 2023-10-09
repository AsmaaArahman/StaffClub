<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

        protected $nat_id;
        protected $fullname;
        protected $password;
        protected $pic;

        protected $fillable =  [
                "nat_id",
                "fullname",
                "password",
                "pic"
        ];


        public function relatives()
        {
                return $this->hasMany(FamilyRelative::class);
        }

        
        // public function faculty()
        // {
        //         return $this->belongsTo(Faculty::class);
        // }

        
}
