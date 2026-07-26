<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\PasswordEmailRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm(): View
    {
        return view('front.auth.forgot-password');
    }

    #[OA\Post(
        path: '/forgot-password',
        summary: 'Request password reset link',
        description: 'Send a password reset link to the given email address.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Reset link sent successfully (JSON) or 302 Redirect (Web)'),
            new OA\Response(response: 422, description: 'Validation error / Email not found')
        ]
    )]
    public function sendResetLinkEmail(PasswordEmailRequest $request)
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($request->expectsJson()) {
            return $status == Password::RESET_LINK_SENT
                ? response()->json(['message' => __($status)], 200)
                : response()->json(['message' => __($status)], 422);
        }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request): View
    {
        return view('front.auth.reset-password', ['request' => $request]);
    }

    #[OA\Post(
        path: '/reset-password',
        summary: 'Reset password',
        description: 'Reset the user password using a token.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['token', 'email', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'token', type: 'string'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'newpassword123'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'newpassword123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Password has been successfully reset (JSON) or 302 Redirect (Web)'),
            new OA\Response(response: 422, description: 'Validation error / Invalid token')
        ]
    )]
    public function reset(PasswordResetRequest $request)
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($request->expectsJson()) {
            return $status == Password::PASSWORD_RESET
                ? response()->json(['message' => __($status)], 200)
                : response()->json(['message' => __($status)], 422);
        }

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
