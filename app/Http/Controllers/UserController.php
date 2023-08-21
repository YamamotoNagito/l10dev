<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $user = User::query()->create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password'])
        ]);
 
        Auth::login($user);
 
        // return redirect()->route('profile');
        return redirect()->route('profile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request)
    {
        $user = User::query()->create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password'])
        ]);
 
        Auth::login($user);
 
        return redirect()->route('profile');
    }

    public function profile()
    {
       return view('profile');
    }

    public function profile2()
    {
        Log::debug("profile2の実行");
        view('profile');
    //    view('profile.blade.php');
    }

    public function logout()
    {
       Auth::logout();

       return redirect('/');
    }

    public function showLogin()
    {
       return view('login');
    }
    
    public function login(Request $request)
    {
        Log::debug($request);
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::debug($credentials);
        
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            Log::debug("メアド・パスワードの両方あってます");
            return redirect()->intended('profile');
        }

        return back();
    }
}
