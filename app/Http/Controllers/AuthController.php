<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function header()
    {
        return view('header');
    }

    public function signup()
    {
        return view('auth/register');
    }

    public function register(User $user, Request $request)
    {
        $request->validate([
           'name' => 'required|min:3',
           'email' => 'required|email',
           'password' => 'required|min:6',
           'cPassword' => 'required|same:password'
        ]);

        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        $user = User::create($inputs);
        $role = Role::where('name', 'User')->first();
        $user->roles()->attach($role);
        return redirect()->route('login')->with('success', 'User created successfuly!');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function authentication(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credetials)) {
            return redirect()->route('index')->with('success', 'login passed successfully!');
        }
        return back()->withErrors([
            'email' => 'Email or password are invalid',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect('auth/login');
    }

    public function adminPanel()
    {
        $users = User::simplePaginate(3);
        $posts= Post::simplePaginate(3);
//        $data = Post::with('user')->get();
        return view('auth/admin', compact('users', 'posts'));
    }

    public function editUserPage(User $user)
    {
        return view('auth/editUser', compact('user'));
    }

    public function editUser(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        if ($request->email){
            $request->validate([
                'email' => 'required|email'
            ]);
        }
        $user->save();
        return redirect()->route('adminPanel')->with('success', 'User updated successfully!');
    }

    public function deleteUser(User $user)
    {
        if ($user->id == auth()->id()){
            return redirect()->back()->with('error', "you can't delete yourself");
        }
        if ($user->posts()->exists()) {
            $user->posts()->delete();
        }
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
