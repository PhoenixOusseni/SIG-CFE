<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiligencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diligences', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('designation')->nullable();
            $table->string('taux')->nullable();
            $table->string('contrainte')->nullable();
            $table->string('pj1')->nullable();
            $table->string('pj2')->nullable();
            $table->string('pj3')->nullable();

            $table->foreignId('personnel_id')->nullable()->constrained('personnels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('marche_id')->nullable()->constrained('marches')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('diligences');
    }
}
