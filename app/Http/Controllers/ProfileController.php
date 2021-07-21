<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UpdateProfileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileService $service
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateProfileService $service)
    {
        $service->update();
        return redirect(route('dashboard'))->with('success', 'Profile updated successfully.');
    }

    /**
     * Increase user balance
     *
     * @return RedirectResponse
     */
    public function topUpBalance()
    {
        User::findOrFail(Auth::id())->increment('balance', 1000);
        return redirect()->back()->with('success', 'Balance increased.');
    }
}
