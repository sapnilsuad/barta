<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Session;

class LoginRegisterController extends Controller
{
    public function create(){ 
        return view('register');   
    }  
    public function store(Request $request){      
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
      
        $user = DB::table('users')->where('email', $request->email)->first();
    
        if (!$user) {
            DB::table('users')->insert([
                'name' => $request->name,
                'username' => $request->username, 
                'email' => $request->email, 
                'password' => Hash::make($request->password),
            ]);
        }  
    return redirect('/');      

    }  
    // login code  
    public function index(){     
        return view('login');       
    }   
    public function login(Request $request){        
        $credentials = $request->only('email', 'password');

        $user = DB::table('users')
            ->where('email', $credentials['email'])
            ->first(); 

        if ($user && password_verify($credentials['password'], $user->password)) {
            Auth::loginUsingId($user->id);

            $userData = DB::table('users')->select('id', 'name', 'email')->where('id', $user->id)->first();

            $request->session()->put('user', $userData);

            return redirect('/profile');  
        } 
 
        return back()->withErrors([ 
            'email' => 'The provided credentials do not match our records.',
        ]); 
    }      
    public function logout(Request $request) 
    { 
        Auth::logout();  

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); 
    }







} 
