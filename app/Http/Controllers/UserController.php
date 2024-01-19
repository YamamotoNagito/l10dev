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
        $existingUser = User::where('userEmail', $request['userEmail'])->first();

        if ($existingUser) {
            // 既に存在する場合はエラーを返すか、任意の処理を行う
            throw ValidationException::withMessages(['userEmail' => 'このメールアドレスはすでに使用されています']);
        }

        $user = User::query()->create([
            'userName'=>$request['userName'],
            'userEmail'=>$request['userEmail'],
            'password'=>Hash::make($request['password']),
            'category'=>$request['category'],
            'faculty'=>$request['faculty'],
            'department'=>$request['department'],
            'admissionYear'=>$request['admissionYear'],
            'createdAt'=>now(),
            'updatedAt'=>now(),
        ]);


        // $user = Auth::user();
        // $user->updateCreatedAt();
        // $user->updateUpdatedAt();

        // ユーザーに権限を付与;
        $user->assignRole('user');
        $user->givePermissionTo('user');

        // 役割・権限の取得
        Log::Debug("ログイン中のユーザー情報:");
        Log::Debug($user->userId);
        Log::Debug($user->getRoleNames());
        Log::Debug($user->getDirectPermissions());

        Auth::login($user);

        // return back();
        // return response()->json(['success' => true,'role' => $user->getRoleNames()]);
        return response()->json(['success' => true,'id' => $user->userId,'role' => $user->getRoleNames()]);
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
    public function show(string $userId)
    {
        Log::Debug("userId");
        Log::Debug($userId);
          // ユーザーを取得
        $user = User::findOrFail($userId);

        // ユーザー情報を連想配列に格納
        $userData = [
            'userName' => $user->userName,
            'userEmail' => $user->userEmail,
            'universityName' => $user->universityName,
            'category' => $user->category,
            'faculty' => $user->faculty,
            'department' => $user->department,
            'admissionYear' => $user->admissionYear,
            'isActive' => $user->isActive,
            'createdAt' => $user->createdAt,
            'updatedAt' => $user->updatedAt,
            'lastLoginAt' => $user->lastLoginAt,
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

        $userEmail = $request->input('userEmail');
        $password = $request->input('password');

        $user = User::where('userEmail', $userEmail)->first();

        if (Auth::attempt(['userEmail' => $userEmail, 'password' => $password])){

            $user = Auth::user();
            $user->updateLastLogin();
            Log::debug($user); // ユーザー情報の取得
            Log::debug(Auth::user()->userId); //ユーザーidの取得

            Log::debug("メアド・パスワードの両方あってます");

            // 役割・権限の取得
            Log::Debug("ログイン中のユーザー情報:");
            Log::Debug($user->getRoleNames());
            Log::Debug($user->getDirectPermissions());

            return response()->json(['success' => true,'id' => $user->userId,'role' => $user->getRoleNames()]);

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
