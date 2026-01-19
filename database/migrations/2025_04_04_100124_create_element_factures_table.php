<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_factures', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->nullable();
            $table->integer('quantite')->nullable();
            $table->integer('prix_unitaire')->nullable();
            $table->integer('montant_total')->nullable();

            $table->foreignId('facture_fournisseurs_id')->constrained('facture_fournisseurs')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('element_factures');
    }
}
