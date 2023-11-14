<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;  

class ProfileController extends Controller
{ 
    public function profile(){      
        $id = Auth::user()->id;   

        $userData = DB::table('users')->select('id', 'name','bio')->where('id', $id)->first();

        return view('profile', ['userData' => $userData]);   
    }      
    public function EditView(){      
        $id = Auth::user()->id;      

        $userData = DB::table('users')->select('id', 'name','bio','email')->where('id', $id)->first();

        return view('edit-profile', ['userData' => $userData]);         
    }  
    public function edit(Request $request){  
        $id = Auth::user()->id; 
 
        $request->validate([    
            'first_name' => 'required',
            'last_name' => 'required',
            'bio' => 'required',   
            'email' => 'required|email',
            'password' => 'required|min:6', 
        ]);
        
        DB::table('users')   
            ->where('id', $id)    
            ->update([       
                'name' => $request->first_name . " " .$request->last_name,
                'email' => $request->email,  
                'password' => Hash::make($request->password),  
                'bio' => trim($request->bio),    
            ]);  
  
        return redirect('/profile'); 
        }

} 
