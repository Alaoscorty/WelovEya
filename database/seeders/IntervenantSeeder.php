<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Intervenant;

class IntervenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Intervenant::factory()->count(20)->create();
    }
}
