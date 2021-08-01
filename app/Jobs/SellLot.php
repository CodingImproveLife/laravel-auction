<?php

namespace App\Jobs;

use App\Models\Lot;
use App\Services\PurchaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SellLot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Lot $lot;

    /**
     * Create a new job instance.
     *
     * @param Lot $lot
     * @return void
     */
    public function __construct(Lot $lot)
    {
        $this->lot = $lot;
    }

    /**
     * Execute the job.
     *
     * @param PurchaseService $purchase
     * @return void
     */
    public function handle(PurchaseService $purchase)
    {
        $purchase->save($this->lot);
    }
}
