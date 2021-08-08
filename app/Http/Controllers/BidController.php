<?php

namespace App\Http\Controllers;

use App\Events\BidEvent;
use App\Services\MakeBidService;
use Illuminate\Http\RedirectResponse;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param MakeBidService $service
     * @return RedirectResponse
     */
    public function store(MakeBidService $service)
    {
        event(new BidEvent($service->bid));
        return back()->with('success', 'Your bid is accepted.');
    }
}
