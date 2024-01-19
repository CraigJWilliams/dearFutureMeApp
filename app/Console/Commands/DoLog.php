<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DoLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:do-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::debug('the time now is : ' . Carbon::now() );
    }
}
