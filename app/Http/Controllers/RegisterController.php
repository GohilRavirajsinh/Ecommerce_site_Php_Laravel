<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\Register;

class RegisterController extends Controller
{
    public function index(){
        $register = Register::all();
        return view('login', compact('login'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

     Register::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
     ]);

     return view('login')->with('registration successfully...');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);
     return view('main')->with('login successfully...');
    }
}
