<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
   public function login(): View {

       return view('auth.login');
   }
        public function auth(LoginRequest $request) {
        $credentials = $request->validated();
       if(Auth::attempt($credentials)){
           $request->session()->regenerate();
           return redirect()->intended(route('blog.index'));
       }

       return to_route('auth.login')->withErrors([
           'email' => 'Invalid Credentials',
       ])->onlyInput('email');
    }
}
