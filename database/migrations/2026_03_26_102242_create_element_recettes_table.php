<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementRecettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_recettes', function (Blueprint $table) {
            $table->id();
            $table->float('quantite')->nullable();
            $table->float('prix_unitaire')->nullable();
            $table->float('montant')->nullable();

            // Retenue details
            $table->float('retenu_bic')->nullable();
            $table->float('autres_retenu')->nullable();
            $table->float('total_retenu')->nullable();

            $table->foreignId('recettes_id')->constrained('recettes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('base_taxables_id')->constrained('base_taxables')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('element_recettes');
    }
}
