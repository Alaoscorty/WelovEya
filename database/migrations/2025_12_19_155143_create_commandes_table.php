<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('commandes')) {
            Schema::create('commandes', function (Blueprint $table) {
                $table->id();
                $table->string('code_commande')->unique();
                $table->string('nom_acheteur');
                $table->string('email')->nullable();
                $table->string('telephone')->nullable();



                $table->date('date_commande')->nullable();
                $table->integer('total_articles')->default(0);
                $table->decimal('total', 15, 2)->default(0);
                $table->string('statut')->default('en-attente'); // en-attente, validée
                $table->string('methode_paiement')->default('espece'); // espece, carte, cheque
                $table->string('paiement_statut')->default('paye'); // paye, en-attente, annule
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
