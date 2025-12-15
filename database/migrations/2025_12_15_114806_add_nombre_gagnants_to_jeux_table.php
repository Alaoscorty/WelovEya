<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('jeux', function (Blueprint $table) {
        $table->integer('nombre_gagnants')->default(1); // ou nullable selon besoin
    });
}

public function down(): void
{
    Schema::table('jeux', function (Blueprint $table) {
        $table->dropColumn('nombre_gagnants');
    });
}

};
