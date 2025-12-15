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
        $table->string('recompense')->nullable(); // type string ou text selon ton besoin
    });
}

public function down(): void
{
    Schema::table('jeux', function (Blueprint $table) {
        $table->dropColumn('recompense');
    });
}

};
