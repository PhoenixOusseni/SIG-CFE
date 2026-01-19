<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->string('objet')->nullable();
            $table->date('date')->nullable();
            $table->date('periode_debut')->nullable();
            $table->date('periode_fin')->nullable();
            $table->string('statut')->nullable();
            $table->date('echeance')->nullable();

            $table->foreignId('users_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('budgets_id')->constrained('budgets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('contribuables_id')->constrained('contribuables')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('recettes');
    }
}
