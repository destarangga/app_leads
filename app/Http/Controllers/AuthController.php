<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 

        if ($user->role === 'admin') {
            $users = User::all();
        } else {
            $users = User::where('id', $user->id)->get();
        }

        return view('auth.index', compact('users'));
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:salesman,admin', 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
        ]);

        return redirect()->route('login')->with('success', 'Registration successful, please login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Redirect ke halaman dashboard setelah login
            return redirect()->route('dashboard')->with('message', 'Login successful');
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    // Logout pengguna
    public function logout()
    {
        auth()->logout();

        // Redirect ke halaman tertentu setelah logout
        return redirect()->route('login')->with('message', 'User logged out successfully');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user(),
        ]);
    }
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); 

        return redirect()->route('auth.index')->with('success', 'Pengguna berhasil dihapus.');
    }

}
