<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marches', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('designation');
            $table->unsignedBigInteger('contribuable_id');
            $table->date('date_debut')->nullable();
            $table->date('date_cloture')->nullable();
            $table->decimal('montant', 15, 2);
            $table->foreign('contribuable_id')->references('id')->on('contribuables')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('base_taxable_id')->constrained('base_taxables')->onUpdate('cascade')->onDelete('cascade');

            $table->string('pj1')->nullable();
            $table->string('pj2')->nullable();
            $table->string('pj3')->nullable();
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
        Schema::dropIfExists('marches');
    }
}
