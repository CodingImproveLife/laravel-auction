<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $updateProfileRequest = new UpdateProfileRequest();

        return array_merge($updateProfileRequest->rules(), [
            'username' => 'required|string|max:255|unique:users,username,' . $this->user->id,
            'email' => 'required|string|email:filter|max:255|unique:users,email,' . $this->user->id,
        ]);
    }
}
