<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Url;
use Carbon\Carbon;;

class ClearExpiredUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:wipe-expirated-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to remove expirated urls from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $url = new Url();
      $url->where('expiration', '<', Carbon::now()->format('Y-m-d H:i:s'))
        ->delete();
    }
}
