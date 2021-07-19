<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfileService
{
    private UpdateProfileRequest $request;
    private User $user;

    public function __construct(UpdateProfileRequest $request)
    {
        $this->request = $request;
        $this->user = User::findOrFail(Auth::id());
    }

    /**
     * Update user profile.
     */
    public function update()
    {
        if (isset($this->request->delete_photo)) {
            $this->deleteUserPhoto();
            $this->user->photo = null;
        }

        if (!empty($this->request->photo)) {
            $this->deleteUserPhoto();
            $this->user->photo = $this->request->photo->store('avatars', 'public');
        }

        $this->user->name = $this->request->name;
        $this->user->save();
    }

    /**
     * Delete user photo from storage.
     */
    private function deleteUserPhoto()
    {
        Storage::disk('local')->delete('public/' . $this->user->photo);
    }
}
