<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UserTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a new user
        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Display the specified user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        // Update the user
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    // Login function
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email', new UserTypeEmail],
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard'); // Redirect to the intended URL or a default path
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }

    // Log the user out
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
