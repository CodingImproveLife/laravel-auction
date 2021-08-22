<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $lots = Lot::where('status', 'sale')
            ->where('end_time', '>', now())
            ->with('user', 'category', 'images', 'bids')
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('home', compact('lots'));
    }
}
