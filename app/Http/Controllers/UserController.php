<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('users.userslist',compact('users'));
    }

    public function addusers(){

        $users = User::orderBy('name', 'ASC')->get();
        
        return view('users.addusers',compact('users'));
    }

    public function submitusers(Request $request){

        $validatedata = Validator::make($request->all(),[
            'name'      =>  'required',
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|min:5|max:12',
            'role'      =>  'required'
        ]);
         if ($validatedata->fails()) {
            return redirect()->back()
                ->withErrors($validatedata)
                ->withInput();
        }

        $users = User::create([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'role'  =>  $request->role,
        ]);
        
        return redirect()->route('users')->with('success','User added');

    }

    public function delete(String $id){

        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('users')->with('success','Data deleted');
    }
}
