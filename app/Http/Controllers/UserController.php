<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class UserController extends Controller
{
    public function userManagement()
    {
        $users = User::get();

        return view(
            'admin.userManagement', 
            [
                'users' => $users,
            ]
        );
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

    public function addUser(Request $request)
    {
        try {
            User::create([
                'userName' => $request->userName,
                'password' => Hash::make($request->password),
                'admin' => 0,
            ]);
        } catch(QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                return back()->withErrors([
                    'errorMessage' => 'username already exists',
                ]);
            }

            return back()->withErrors([
                'errorMessage' => 'could not add user, unknown error',
            ]);
        }
        
        return redirect()
            ->back()
            ->with('successMessage', $request->userName . ' successfully added');
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::where('id', $request->userId)->first();

            $user->delete();
        } catch(QueryException $e) {
            return back()->withErrors([
                'errorMessage' => 'Error deleteing league',
            ]);
        }
        
        return redirect()
            ->back()
            ->with('successMessage', $request->userName . ' successfully deleted');
    }

    public function editUser(Request $request)
    {
        try {
            $user = User::where('id', $request->userId)->first();
            $user->password = Hash::make($request->newPassword);

            $user->save();
        } catch(QueryException $e) {
            return back()->withErrors([
                'errorMessage' => 'Error editing user password',
            ]);
        }
        
        return redirect()
            ->back()
            ->with('successMessage', $request->userName . ' password successfully updated');
    }
}