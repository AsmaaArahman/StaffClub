<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminInfo extends Controller
{
        public function index () {
                return view("admin/adminInfo");
        }
}
