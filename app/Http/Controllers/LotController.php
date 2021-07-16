<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLotRequest;
use App\Models\Lot;
use App\Services\Lot\DeleteService;
use App\Services\Lot\StoreService;
use App\Services\Lot\UpdateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $lots = Lot::where('user_id', Auth::id())
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('lots.all', compact('lots'));
    }

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
        return redirect()->route('lots.index')->with('success', 'Lot created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $lot = Lot::findOrFail($id);
        return view('lots.one', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $lot = Lot::findOrFail($id);
        return view('lots.edit', compact('lot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreLotRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreLotRequest $request, int $id)
    {
        UpdateService::update($request, $id);
        return redirect()->route('lots.show', $id)->with('success', 'Lot update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        DeleteService::delete($id);
        return redirect()->route('lots.index')->with('success', 'Lot delete successfully.');
    }
}
