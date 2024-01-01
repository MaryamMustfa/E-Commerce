<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $roles = Role::pluck('name', 'id');
        return view('login', compact('roles'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // dd($user->role->name, Auth::check());

            if ($user->role !== null && in_array($user->role->name, ['admin', 'shop', 'user'])) {
                // User has a valid role, redirect based on the role
                return $this->directToRoute($user->role->name);
            }

            // User has an unrecognized role or no role assigned
            Auth::logout(); // Log out the user
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function showRegistrationForm()
    {
        $roles = Role::whereIn('name', ['shop', 'user'])->pluck('name', 'id');
        return view('register', compact('roles'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role'),
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }

    protected function directToRoute($role)
{
    $user = Auth::user();
    
    // dd($user->role->name);

    if ($user->role->name == 'admin') {
        return redirect()->route('admin.allShops');
    } elseif ($user->role->name == 'shop') {
        
        return redirect()->route('shop.create');
    } elseif ($user->role->name == 'user') {
        return redirect()->route('home');
    } 
    else {
        return redirect()->route('login')->with('error', 'Invalid user role. Please try again.');
    }
}


    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->route('login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => trans('auth.failed'),
            ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
