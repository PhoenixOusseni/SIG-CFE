<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteres', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('designation')->nullable();
            $table->string('taux')->nullable();
            $table->longText('appreciation')->nullable();
            $table->string('pj1')->nullable();
            $table->string('pj2')->nullable();
            $table->string('pj3')->nullable();

            $table->foreignId('diligence_id')->nullable()->constrained('diligences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('criteres');
    }
}
