<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    public function create(Request $request): View
    {
        return view('Authentication.reset-password', ['request' => $request]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // تأكد إن التوكن يخص الإيميل دا فعلاً من جدول password_reset_tokens
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (! $record || !Hash::check($request->token, $record->token)) {
            return back()->withInput()
                         ->withErrors(['token' => 'Reset link is invalid or expired.']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return to_route('userLogin')->with('status', 'Password updated successfully! You can login now.');
        }

        // fallback لأي حالة غير متوقعة
        return back()->withInput()
                     ->withErrors(['email' => __($status)]);
    }
}
