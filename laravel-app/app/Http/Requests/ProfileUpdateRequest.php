<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        
        'name' => 'sometimes|string|max:255',
        
        
        'email' => 'sometimes|email|max:255',
        
       
        'birthday' => 'sometimes|date|nullable',

        'about_me' => 'sometimes|string|nullable',
        
        
        'profile_picture' => 'sometimes|image|max:2048|nullable',
        
        
    ];
}

}