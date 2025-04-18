<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Menggunakan middleware melalui route daripada controller
        // karena Laravel 12 tidak lagi menggunakan controller middleware secara langsung
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request): View
    {
        // Jika data throttle ada di session, gunakan itu
        if ($request->session()->has('throttled')) {
            return view('admin.login', [
                'throttled' => true,
                'seconds' => $request->session()->get('seconds', 60),
                'minutes' => $request->session()->get('minutes', 1),
            ]);
        }
        
        // Periksa status throttle dari IP dan email terakhir (jika ada)
        $key = $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return view('admin.login', [
                'throttled' => true,
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]);
        }
        
        return view('admin.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if the user is throttled and return to login page with cooldown timer
        $key = $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            event(new Lockout($request));
            
            $errorMessage = __('Terlalu banyak percobaan login. Silakan coba lagi dalam :minutes menit.', [
                'minutes' => ceil($seconds / 60),
            ]);
            
            return redirect()->route('login')
                ->withInput(['email' => $request->input('email')])
                ->withErrors(['email' => $errorMessage])
                ->with([
                    'throttled' => true,
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Reset throttle after successful login
            RateLimiter::clear($this->throttleKey($request));

            return redirect()->intended($this->redirectTo);
        }

        // Increment throttle counter on failed login
        RateLimiter::hit($this->throttleKey($request));
        
        $attemptsLeft = 5 - RateLimiter::attempts($key);
        
        // Jika sudah melebihi batas, langsung redirect dengan cooldown
        if ($attemptsLeft <= 0) {
            $seconds = RateLimiter::availableIn($key);
            $errorMessage = __('Terlalu banyak percobaan login. Silakan coba lagi dalam :minutes menit.', [
                'minutes' => ceil($seconds / 60),
            ]);
            
            return redirect()->route('login')
                ->withInput(['email' => $request->input('email')])
                ->withErrors(['email' => $errorMessage])
                ->with([
                    'throttled' => true,
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]);
        }
        
        $message = __('Email atau password tidak valid. Sisa percobaan: :attempts', ['attempts' => $attemptsLeft]);
        
        throw ValidationException::withMessages([
            'email' => $message,
        ]);
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request): string
    {
        return strtolower($request->input('email') ?? '') . '|' . $request->ip();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
} 