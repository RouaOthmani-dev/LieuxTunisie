<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('devis', function (Blueprint $table) {
        $table->decimal('budget', 10, 2)->after('lieu_recherche')->nullable();
    });
}

public function down()
{
    Schema::table('devis', function (Blueprint $table) {
        $table->dropColumn('budget');
    });
}
};
