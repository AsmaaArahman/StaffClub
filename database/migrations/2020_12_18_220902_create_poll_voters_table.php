<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_voters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("member_id");
            $table->unsignedBigInteger("poll_id");

            $table->foreign("member_id")->references("id")->on("members")->onDelete("cascade");
            $table->foreign("poll_id")->references("id")->on("polls")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_voters');
    }
}
