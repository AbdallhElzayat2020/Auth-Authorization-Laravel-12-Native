<?php

namespace App\Http\Requests\Auth;

use App\Rules\RecaptchaV3Rule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identifier' => ['required', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'remember' => ['nullable', 'in:on,off'],
//            'g-recaptcha-response' => ['required', new RecaptchaV3Rule()],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ];
    }
}
