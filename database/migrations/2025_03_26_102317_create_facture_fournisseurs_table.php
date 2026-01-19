<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('statut');
            $table->float('tva')->nullable();
            $table->string('objet')->nullable();

            $table->float('retenu_bic')->nullable();
            $table->float('retenu_arcop')->nullable();
            $table->float('penalite')->nullable();
            $table->float('total_retenu')->nullable();

            $table->foreignId('users_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fournisseurs_id')->constrained('fournisseurs')->onDelete('cascade');
            $table->foreignId('budgets_id')->constrained('budgets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('signataires_id')->constrained('signataires')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('facture_fournisseurs');
    }
}
