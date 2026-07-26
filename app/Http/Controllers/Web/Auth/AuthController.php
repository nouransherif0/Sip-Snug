<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('front.auth.login');
    }

    #[OA\Post(
        path: '/login',
        summary: 'Login user',
        description: 'Authenticate a user and create a session.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successfully authenticated (JSON) or 302 Redirect (Web)'),
            new OA\Response(response: 422, description: 'Validation error / Invalid credentials')
        ]
    )]
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Successfully authenticated',
                'user' => $request->user()
            ], 200);
        }

        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('home', absolute: false));
    }

    public function showRegisterForm(): View
    {
        return view('front.auth.register');
    }

    #[OA\Post(
        path: '/register',
        summary: 'Register a new user',
        description: 'Create a new user account and authenticate them.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Successfully registered (JSON) or 302 Redirect (Web)'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Successfully registered',
                'user' => $user
            ], 201);
        }

        return redirect(route('home', absolute: false));
    }

    #[OA\Post(
        path: '/logout',
        summary: 'Logout user',
        description: 'Destroy the authenticated session.',
        tags: ['Authentication'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successfully logged out (JSON) or 302 Redirect (Web)')
        ]
    )]
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Successfully logged out'], 200);
        }

        return redirect('/');
    }

    #[OA\Put(
        path: '/password',
        summary: 'Update password',
        description: 'Update the authenticated user password.',
        tags: ['Authentication'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['current_password', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'current_password', type: 'string', format: 'password', example: 'oldpassword123'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'newpassword123'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'newpassword123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Password successfully updated (JSON) or 302 Redirect (Web)'),
            new OA\Response(response: 422, description: 'Validation error / Incorrect current password')
        ]
    )]
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Password successfully updated'], 200);
        }

        return back()->with('status', 'password-updated');
    }
}
