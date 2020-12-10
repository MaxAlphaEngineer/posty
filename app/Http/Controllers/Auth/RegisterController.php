<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        User::create([
           'name'=>$request->name,
           'username'=>$request->username,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email','password'));

        return redirect()->route('dashboard');
    }
}
