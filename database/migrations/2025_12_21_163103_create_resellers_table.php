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
    Schema::create('resellers', function (Blueprint $table) {
        $table->id();
        $table->string('nom_complet');
        $table->string('email')->nullable();
        $table->string('telephone')->nullable();
        $table->date('date_adhesion')->nullable();
        $table->string('statut')->default('ACTIF');
        $table->integer('commission_standard')->default(0);
        $table->integer('commission_premium')->default(0);
        $table->integer('commission_vip')->default(0);
        $table->integer('commission_elite')->default(0);
        $table->integer('stock_standard')->default(0);
        $table->integer('stock_premium')->default(0);
        $table->integer('stock_vip')->default(0);
        $table->integer('stock_elite')->default(0);
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
        Schema::dropIfExists('resellers');
    }
};
