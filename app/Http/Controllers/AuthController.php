<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }
    public function register(Request $request){
        $validated= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'picture' => 'image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'nullable|string|max:1000'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        if ($request->hasFile('picture')){
            $filepath = $request->file('picture')->store('avatars','public');
            $validated['picture'] = $filepath;
        }
        $validated['email_verified_at'] = now();
        $user= User::create($validated);
        Auth::login($user);
        return redirect()->route('movies.index',['user'=>$user])->with('success', 'Registration successful.');
    }

    public function loginForm(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->intended(route('movies.index'))->with('success',"Logged in successfully");
        }
        else{
            return back()->withErrors(['email'=>"Invalid email or password."]);
        };
    }

        public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('movies.index');
        }
        
}
