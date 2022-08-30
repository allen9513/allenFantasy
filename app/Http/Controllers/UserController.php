<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller
{
    public function test(Request $request)
    {
        $credentials = $request->validate([
            'userName' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return back();
        }
        
        return $request->userName;
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'userName' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->back()->with('successMessage', 'Login Successful');
        }
 
        return back()->withErrors([
            'errorMessage' => 'Login failed, invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect('/')->with('successMessage', 'Logout Successful');
    }
}