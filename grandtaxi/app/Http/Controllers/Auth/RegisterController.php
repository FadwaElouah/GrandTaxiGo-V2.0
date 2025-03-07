<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Location;


class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $locations = Location::all();
        return view('auth.register', compact('locations'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     *  public function showRegisterForm()

     */



    public function store(Request $request)

    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:passenger,driver'],
            'phone' => ['required', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle file upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
        } else {
            $path = null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'profile_photo_path' => $path,
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'driver') {
            return redirect()->route('driver-dashboard');
        }

        return redirect()->route('passenger-dashboard');
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }
}
