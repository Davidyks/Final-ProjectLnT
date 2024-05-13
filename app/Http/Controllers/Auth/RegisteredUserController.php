<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:3'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:6', 'max:12','confirmed', Rules\Password::defaults()],
            'NomorTelpon' => ['required', 'string','regex:/^[0-9]+$/', function ($attribute, $value, $fail) {
                if (substr($value, 0, 2) !== '08') {
                    $fail('The ' . $attribute . ' must start with 08.');
                }
            }]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'NomorTelpon' => $request->NomorTelpon
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
