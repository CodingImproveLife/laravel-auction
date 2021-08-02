<?php

namespace App\Console\Commands;

use App\Models\Lot;
use Illuminate\Console\Command;

class SellLotsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sell-lots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Choosing buyers for lots on sale';

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
     */
    public function handle()
    {
        Lot::where('end_time', '<', now())
            ->where('status', 'sale')
            ->get()
            ->each(function ($lot) {
                \App\Jobs\SellLot::dispatch($lot);
            });
    }
}
