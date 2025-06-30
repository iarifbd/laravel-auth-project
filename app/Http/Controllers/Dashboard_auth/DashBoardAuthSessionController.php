<?php

namespace App\Http\Controllers\Dashboard_auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DashBoardAuthSessionController extends Controller
{

    /**
     * Show the form for Dashboard display.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames()->implode(', ');

        $data = [
            'role' => $roles,
            'name' => $user->name,
            'email' => $user->email,
        ];

        // Role-based view rendering
        if ($user->hasRole('Admin')) {
            return view('dashboard_templet.index',$data);
        } elseif ($user->hasRole('teacher')) {
            return "I am teacher.";
        } elseif ($user->hasRole('Writer')) {
            return "I am writer.";
        } else {
            return view('welcome');
        }
    }

    /**
     * Show the form for login_page display.
     */
    public function login_page()
    {
        return view('dashboard_templet.login');
    }

    /**
     * Store a newly login form data verify.
     */
    public function verify_logindata(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Display the registration page.
     */
    public function reg_page()
    {
        return view('dashboard_templet.reg');
    }

    /**
     * Show the form registratin data veryfy.
     */

    public function verify_regdata(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function log_out(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/');
        return redirect()->intended(route('admin_login', absolute: false));
    }

}
