<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("member_id");
            $table->unsignedBigInteger("question_id");
            $table->unsignedBigInteger("option_id");


            $table->foreign("member_id")->references("id")->on("members")->onDelete("cascade");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade");
            $table->foreign("option_id")->references("id")->on("options")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
