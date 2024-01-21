<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AuthController
 *
 * Handles authentication related actions such as login, logout, and user authentication.
 */
class AuthController extends Controller
{
    /**
     * Show the login view.
     *
     * @return View Returns the login view.
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param LoginRequest $request The login request containing credentials.
     * @return \Illuminate\Http\RedirectResponse Redirects to the intended route on successful login or back to login with errors on failure.
     */
    public function auth(LoginRequest $request) : RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }

        return to_route('auth.login')->withErrors([
            'email' => 'Invalid Credentials',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse Redirects to the login route.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return to_route('auth.login');
    }
}
