<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function hello(): string
    {
        // return view('login');
        return 'Hello World';
        // return 0;
    }

    public function profile()
    {
        Log::debug("profile画面を表示します");
        // return view('profile.blade.php');
        return view('profile');
    //    return View::make('profile.blade.php');
    }

    public function register(Request $request)
    {
        // メールアドレスがすでに存在するか確認
        $existingUser = User::where('user_email', $request['user_email'])->first();

        if ($existingUser) {
            // 既に存在する場合はエラーを返すか、任意の処理を行う
            throw ValidationException::withMessages(['user_email' => 'このメールアドレスはすでに使用されています']);
        }

        $user = User::query()->create([
            'user_name'=>$request['user_name'],
            'user_email'=>$request['user_email'],
            'password'=>Hash::make($request['password']),
            'category'=>$request['category'],
            'faculty'=>$request['faculty'],
            'department'=>$request['department'],
            'admission_year'=>$request['admission_year'],
            'last_login_at'=>now(),
        ]);
 
        Auth::login($user);
 
        return back();
        // return redirect()->route('profile');
    }

    public function login(Request $request)
    {
        Log::debug($request);
        
        // $credentials = $request->validate([
        //     'user_email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);
        $credentials = [
            'user_email' => $request->input('user_email'),
            'password' => $request->input('password'),
        ];

        $credentials = $request->only('user_email', 'password');

        $user_email = $request->input('user_email');
        $password = $request->input('password');

        Log::debug($credentials);
        Log::debug(Auth::attempt($credentials));
        
        // if (Auth::attempt($credentials)) {
        if (Auth::attempt(['user_email' => $user_email, 'password' => $password])){         
            
            // $request->session()->regenerate();
            
            Log::debug("メアド・パスワードの両方あってます");

            //最終ログイン日時の更新
            // $user = Auth::user();
            // $user->update(['last_login_at' => now()]);
            
            // return redirect()->intended('profile');
            
            return response()->json(['success' => true]);

            // return view('profile');

        }
        else{
            return response()->json(['success' => false]);
            Log::debug("メアド・パスワードのどちらかが間違ってます");
        }

        return back();
    }

    public function logout()
    {
       Auth::logout();
       return back();

    //    return redirect('/');
    }
}
