<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglement_factures', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('net')->nullable();
            $table->integer('versement')->nullable();
            $table->integer('reste')->nullable();
            $table->string('mode_reglement')->nullable();

            $table->foreignId('recettes_id')->constrained('recettes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('reglement_factures');
    }
}
