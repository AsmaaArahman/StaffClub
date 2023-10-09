<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("fullname", 1000);
            $table->string("nat_id", 14);
            $table->enum("gender", ["male", "female"])->nullable();
            $table->string("phone")->nullable();
            $table->double("age", 10)->nullable();
            $table->string("password", 1000); 
            $table->boolean("logout")->default(false);
            $table->string("pic")->nullable()->default("default.jpg");
            //NOTE(walid): 1 ==> manager  , 2 ==> normal moderator , 3 ==> reception
            $table->integer("role")->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mods');
    }
}
