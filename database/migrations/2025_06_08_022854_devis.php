<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devis',function(Blueprint $table){
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('telephone');
            $table->string('type_projet');
            $table->integer('nb_jours');
            $table->string('lieu_recherche');
            $table->string('budjet')->nullable();
            $table->text('message')->nullable();
            $table->string('statut')->default('nouveau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
