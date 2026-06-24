<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterAdminRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredAdminController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterAdminRequest $request): RedirectResponse
    {
        $admin = User::query()->create([
            ...$request->validated(),
            'role' => 'admin',
        ]);

        Auth::login($admin);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('status', 'Admin account created.');
    }
}
