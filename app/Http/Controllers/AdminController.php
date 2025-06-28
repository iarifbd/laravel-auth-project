<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        $roles = $user->getRoleNames()->implode(', '); // Convert roles to comma-separated string

        return view('dashboard_templet.index', [
            'role' => $roles,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function loginPage(){
        return view('dashboard_templet.login');
    }

    /**
     * Display a login of the resource.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        session()->regenerate();

        return redirect()->intended(route('admin_dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function log_out(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/');
        return redirect()->route('user_login');
    }


}
