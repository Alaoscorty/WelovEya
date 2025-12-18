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
   public function up()
{
    Schema::table('votes', function (Blueprint $table) {
        $table->string('type')->after('intervenant_id'); // type de vote, par ex. 'classique' ou 'hits'
    });
}

public function down()
{
    Schema::table('votes', function (Blueprint $table) {
        $table->dropColumn('type');
    });
}

};
