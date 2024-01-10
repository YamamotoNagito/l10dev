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
        ]);
 
        Auth::login($user);
 
        return back();
        // return redirect()->route('profile');
    }

    public function login(Request $request)
    {
        $user_email = $request->input('user_email');
        $password = $request->input('password');

        $user = User::where('user_email', $user_email)->first();
        
        if (Auth::attempt(['user_email' => $user_email, 'password' => $password])){  
          
            $user = Auth::user();
            $user->updateLastLogin();
            Log::debug($user); // ユーザー情報の取得
            Log::debug(Auth::user()->user_id); //ユーザーidの取得

            
            Log::debug("メアド・パスワードの両方あってます");
          
            return response()->json(['success' => true]);

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
    }
}
