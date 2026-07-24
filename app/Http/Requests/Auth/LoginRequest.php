<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

// Defines the structure and properties of this class
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // Checks if the current user has permission to perform this action
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    // Specifies the validation rules that incoming data must pass
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required.',
            'email.string' => 'Email must be a string.',
            'email.numeric' => 'Email must be a number.',
            'email.integer' => 'Email must be an integer.',
            'email.exists' => 'The selected Email is invalid.',
            'email.boolean' => 'Email must be true or false.',
            'email.array' => 'Email must be an array.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email exceeds the maximum allowed length.',
            'email.min' => 'Email is below the minimum allowed length.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.numeric' => 'Password must be a number.',
            'password.integer' => 'Password must be an integer.',
            'password.exists' => 'The selected Password is invalid.',
            'password.boolean' => 'Password must be true or false.',
            'password.array' => 'Password must be an array.',
            'password.email' => 'Password must be a valid email address.',
            'password.max' => 'Password exceeds the maximum allowed length.',
            'password.min' => 'Password is below the minimum allowed length.',
        ];
    }
}
