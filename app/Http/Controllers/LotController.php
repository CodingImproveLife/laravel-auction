<?php

namespace App\Http\Controllers;

use App\Services\Lot\StoreService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LotController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('lots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreService $service
     * @return RedirectResponse
     */
    public function store(StoreService $service)
    {
        $service->saveLot();
        return redirect()->route('dashboard')->with('success', 'Lot created successfully.');
    }
}
