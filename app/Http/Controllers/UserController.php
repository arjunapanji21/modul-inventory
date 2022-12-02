<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login(){
        if(Auth::check()){
            return redirect(route('dashboard'));
        }else{
            return view('auth.login', [
                'title' => 'Login'
            ]);
        }
    }

    public function register()
    {
        if(Auth::check()){
            return redirect(route('dashboard'));
        }else{
            return view('auth.register', [
                'title' => 'Registration',
            ]);
        }
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('dashboard'));
        }
 
        return back()->with(['error', 'Login failed!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('user.login'));
    }

    public function forgot_password(Request $request)
    {
        return view('auth.forgot', [
            'title' => 'Forgot Password',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);

        try {
            User::create($data);
            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect(route('dashboard'))->with(['success', 'Account Registration Completed!']);
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with(['error', $th]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
