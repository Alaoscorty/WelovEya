<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
                $table->string('nom_article');
                $table->string('type_article')->nullable();
                $table->decimal('prix_unitaire', 15, 3)->default(0);
                $table->integer('quantite')->default(0);
                $table->decimal('total', 15, 3)->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('articles_commandes');
    }
};
