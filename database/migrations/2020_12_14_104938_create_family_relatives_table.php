<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyRelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_relatives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nat_id", 14)->nullable();
            $table->string("fullname", 1000);
            $table->enum("gender", ["male", "female"])->nullable();
            $table->double("age", 10, 2)->nullable();
            $table->text("pic")->nullable();
            $table->unsignedBigInteger("member_id");
            $table->unsignedBigInteger("kinship_id");
            
            $table->foreign("member_id")->references("id")->on("members")->onDelete("cascade");
            $table->foreign("kinship_id")->references("id")->on("kinships");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_relatives');
    }
}
