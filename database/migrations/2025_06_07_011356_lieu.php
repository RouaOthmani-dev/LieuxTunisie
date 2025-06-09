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
    Schema::create('lieus', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->unsignedBigInteger('categorie_id'); // Clé étrangère
        $table->text('description');
        $table->string('image')->nullable();
        $table->string('region');
        $table->string('adresse')->nullable(); 
        $table->timestamps();

        // Clé étrangère
        $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
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
