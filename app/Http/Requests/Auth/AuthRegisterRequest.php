<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @OA\Schema()
 */
class AuthRegisterRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      property="name",
     *      type="string",
     *      example="Bob"
     * ),
     *
     * @OA\Property(
     *      property="email",
     *      type="string",
     *      example="typical@email.com"
     * ),
     *
     * @OA\Property(
     *      property="password",
     *      type="string",
     *      example="Qwerty!12345"
     * ),
     *
     * @OA\Property(
     *      property = "password_confirmation",
     *      type = "string",
     *      example = "Qwerty!12345"
     * ),
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $password = Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised();

        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', 'confirmed', $password]
        ];
    }
}
