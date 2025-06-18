<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::latest()->paginate(10)
        ]);
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

    public function myProfile()
    {
        return view('users.myprofile', ['user' => auth()->user()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('myprofile');
        }
        
        if (auth()->user()->isAdmin()) {
            return view('users.profile', ['user' => $user]);
        }
        
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function profile(User $user)
    {
        if(auth()->user()->isAdmin()){
            return view('users.my.profile', ['user'=>$user]);
        }
        else{
        $user= auth()->user();
        return view('users.profile', ['user' => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request, User $user = null)
    {
        $user = $user ?? auth()->user();


        if ($user->id !== auth()->id()) {
            if (!auth()->user()->isAdmin()) {
                return back()->withErrors(['error' => 'Unauthorized action.']);
            }

            if ($user->isAdmin()) {
                return back()->withErrors(['error' => 'Admins cannot edit other admins.']);
            }
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'about' => 'nullable|string|max:1000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('picture')) {
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }
            $filepath = $request->file('picture')->store('avatars', 'public');
            $validated['picture'] = $filepath;
        }

        $user->update($validated);

        if ($user->id === auth()->id()) {
            return redirect()->route('myprofile')->with('success', 'Profile updated successfully.');
        } 
        elseif (auth()->user()->isAdmin()) {
            return redirect()->route('users.show', $user)->with('success', 'User updated successfully.');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('movies.index')->with('success', 'Logged out successfully.');
    }

    public function destroy(User $user)
    {

        if (!(auth()->user()->isAdmin() || $user->id === auth()->id())) {
            return redirect()->route('users.index')->withErrors(['error'=> 'Unauthorized action.']);
        }

        // If deleting own account
        if ($user->id === auth()->id()) {
            // Delete all their movies
            $movies = Movie::where('user_id', $user->id)->get();
            foreach ($movies as $movie) {
                if ($movie->picture) {
                    Storage::disk('public')->delete($movie->picture);
                }
                $movie->delete();
            }
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }
            auth()->logout();
            $user->delete();
            return redirect()->route('movies.index')->with('success', 'Your account has been deleted successfully.');

        }

        if(!$user->isAdmin()){
            $admin = auth()->user();
            Movie::where('user_id', $user->id)->update(['user_id' => $admin->id]);
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted and movies reassigned successfully.');
        }
        else{
            return back()->withErrors(['error'=> 'Cannot delete an admin user.']);
        }
    }
}
