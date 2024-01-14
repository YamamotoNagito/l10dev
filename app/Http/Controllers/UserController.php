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
use Spatie\Permission\Models\Role;

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
    // 新規登録時の処理
    public function create(Request $request)
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

        // ユーザーに権限を付与;
        $user->assignRole('user');
        $user->givePermissionTo('user');

        // 役割・権限の取得
        Log::Debug("ログイン中のユーザー情報:");
        Log::Debug($user->user_id);
        Log::Debug($user->getRoleNames());
        Log::Debug($user->getDirectPermissions());

        Auth::login($user);

        // return back();
        // return response()->json(['success' => true,'role' => $user->getRoleNames()]);
        return response()->json(['success' => true,'id' => $user->user_id,'role' => $user->getRoleNames()]);
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
    public function show(string $user_id)
    {
        Log::Debug("user_id");
        Log::Debug($user_id);
          // ユーザーを取得
        $user = User::findOrFail($user_id);

        // ユーザー情報を連想配列に格納
        $userData = [
            'user_name' => $user->user_name,
            'user_email' => $user->user_email,
            'university_name' => $user->university_name,
            'category' => $user->category,
            'faculty' => $user->faculty,
            'department' => $user->department,
            'admission_year' => $user->admission_year,
            'is_active' => $user->is_active,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'last_login_at' => $user->last_login_at,
        ];

        // JSON形式でデータを返す
        return response()->json($userData);
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

            // 役割・権限の取得
            Log::Debug("ログイン中のユーザー情報:");
            Log::Debug($user->getRoleNames());
            Log::Debug($user->getDirectPermissions());

            return response()->json(['success' => true,'id' => $user->user_id,'role' => $user->getRoleNames()]);

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
