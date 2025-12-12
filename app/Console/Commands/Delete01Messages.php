<?php

namespace App\Console\Commands;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Delete01Messages extends Command
{
    protected $signature = 'messages:clean';

    protected $description = 'Supprime les messages vieux de plus de 90 jours';

    public function handle()
    {
        $count =
        Message::where('created_at', '<', Carbon::now()->subDays(30))->delete();
        $this->info("$count messages supprimés.");
    }
}
