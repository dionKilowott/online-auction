<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email', 
            'password' => 'required|string',
        ]);


        if(Auth::attempt($validated)){ // Attempt to log in the user with the provided credentials
        
            $request->session()->regenerate(); // Regenerate the session to prevent fixation
        
            return redirect()->route('home');
        }
        throw ValidationException::withMessages([
            'credentials' => 'sorry, incorrect credentials'
        ]);

    }


    public function register(Request $request) // Request instantiates a new request and injects it in $request
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users', //unique to the users table
            'password' => 'required|string|min:8|confirmed',
        ]);
       $user = User::create($validated); //using the User Model and the create function on it. //we pass in the validated variable // which adds it to the table.
    
        Auth::login($user);                        //use the Auth from Iluminate/support/facades 

        return view('auth.login');

        // return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('home');
    }

}
