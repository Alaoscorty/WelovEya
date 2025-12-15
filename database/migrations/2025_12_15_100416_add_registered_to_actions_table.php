<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    if (!Schema::hasColumn('actions', 'registered')) {
        Schema::table('actions', function (Blueprint $table) {
            $table->integer('registered')->default(0);
        });
    }
}


    public function down(): void
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->dropColumn('registered');
        });
    }
};
