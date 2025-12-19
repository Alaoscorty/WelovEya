<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('intervenants', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('role')->default('artiste'); // artiste | animateur | dj
            $table->string('statut')->default('en-attente'); // confirme | en-attente
            $table->string('photo')->nullable();
                // Infos de base
            $table->string('nom');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('region')->nullable();
            $table->string('pays')->nullable();
            $table->date('date_debut')->nullable();
            $table->timestamps();
            // Programmation
            $table->string('jour_evenement')->nullable();
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            // Vote
             $table->boolean('vote_actif')->default(false);
            $table->date('date_limite_vote')->nullable();
            // Fichiers paroles
            $table->string('paroles_classiques')->nullable();
            $table->string('paroles_hits')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('intervenants');
    }
};
