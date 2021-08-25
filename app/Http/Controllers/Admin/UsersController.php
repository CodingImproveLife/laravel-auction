<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::orderByDesc('updated_at')
            ->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  User $user
     */
    public function update(UpdateRequest $request, User $user)
    {
        if (isset($request->delete_photo)) {
            Storage::disk('local')->delete('public/' . $user->photo);
            $user->photo = null;
        }

        if (!empty($request->photo)) {
            Storage::disk('local')->delete('public/' . $user->photo);
            $user->photo = $request->photo->store('avatars', 'public');
        }

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User is update.');
    }
}
