<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billet_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('email')->unique();
            $table->boolean('paiement_confirme')->default(false);
            $table->string('transaction_id')->nullable();
            $table->string('code_acces')->nullable();
            $table->enum('statut', ['utilisé', 'non-utilisé', 'bloqué'])->default('non-utilisé');
            $table->timestamp('premiere_connexion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};

