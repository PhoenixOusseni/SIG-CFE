<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcheDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marche_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marche_id');
            $table->unsignedBigInteger('personnel_id');
            $table->string('temps')->nullable();
            $table->foreign('marche_id')->references('id')->on('marches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personnel_id')->references('id')->on('personnels')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marche_details');
    }
}
