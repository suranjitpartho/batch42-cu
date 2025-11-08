<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            $user = $request->user();
        } else {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            $user = User::where('email', $request->email)->first();
        }

        if (! $user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('home', absolute: false));
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
