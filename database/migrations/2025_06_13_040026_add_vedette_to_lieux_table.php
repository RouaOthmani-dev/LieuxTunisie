<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lieus', function (Blueprint $table) {
            $table->boolean('vedette')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('lieus', function (Blueprint $table) {
            $table->dropColumn('vedette');
        });
    }
};
