<?php

// database/migrations/xxxx_create_intervenants_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('intervenants', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // INT-001
            $table->string('nom');
            $table->string('email')->unique();
            $table->enum('role', ['artiste', 'animateur', 'dj']);
            $table->enum('statut', ['en_attente', 'confirme'])->default('en_attente');
            $table->time('heure');
            $table->date('date');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('intervenants');
    }
};
