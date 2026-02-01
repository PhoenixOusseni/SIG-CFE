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
            $table->string('code')->nullable();
            $table->string('reference')->nullable();
            $table->date('date')->nullable();

            $table->string('statut')->nullable();
            $table->date('echeance')->nullable();

            $table->foreignId('users_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('contribuables_id')->nullable()->constrained('contribuables')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('signataires_id')->nullable()->constrained('signataires')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('marche_id')->nullable()->constrained('marches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
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
