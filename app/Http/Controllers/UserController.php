<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Reviews;
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
        $messages = [
            'userName.required' => 'ユーザー名は必須項目です。',
            'userName.string' => 'ユーザー名は文字列である必要があります。',
            'userName.max' => 'ユーザー名は255文字以内で入力してください。',

            'userEmail.required' => 'メールアドレスは必須項目です。',
            'userEmail.string' => 'メールアドレスは文字列である必要があります。',
            'userEmail.email' => 'メールアドレスの形式が正しくありません。',
            'userEmail.max' => 'メールアドレスは255文字以内で入力してください。',
            'userEmail.unique' => 'このメールアドレスは既に使用されています。',

            'password.required' => 'パスワードは必須項目です。',
            'password.string' => 'パスワードは文字列である必要があります。',
            'password.min' => 'パスワードは最低8文字必要です。',
            'password.max' => 'パスワードは255文字以内で入力してください。',

            'category.required' => 'カテゴリは必須項目です。',
            'category.string' => 'カテゴリは文字列である必要があります。',
            'category.max' => 'カテゴリは255文字以内で入力してください。',

            'faculty.required' => '学部は必須項目です。',
            'faculty.string' => '学部は文字列である必要があります。',
            'faculty.max' => '学部は255文字以内で入力してください。',

            'department.required' => '学科は必須項目です。',
            'department.string' => '学科は文字列である必要があります。',
            'department.max' => '学科は255文字以内で入力してください。',

            'admissionYear.required' => '入学年度は必須項目です。',
            'admissionYear.string' => '入学年度は文字列である必要があります。',
            'admissionYear.max' => '入学年度は255文字以内で入力してください。',
        ];

        $validatedData = $request->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255',
            'category' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'admissionYear' => 'required|string|max:255',
        ], $messages);

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

        // ユーザーに権限を付与;
        $user->assignRole('user');
        $user->givePermissionTo('user');

        // 役割・権限の取得
        Log::Debug("ログイン中のユーザー情報:");
        Log::Debug($user->userId);
        Log::Debug($user->getRoleNames());
        Log::Debug($user->getDirectPermissions());

        Auth::login($user);

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

         // Reviewsテーブルのlecture_idを基にレビュー一覧の取得
         $reviews = Reviews::where('userId', $userId)
         // ->select('attendance_year', 'attendance_confirm', 'weekly_assignments', 'midterm_assignments', 'final_assignments')
         ->select('reviewId','attendanceYear', 'attendanceConfirm', 'weeklyAssignments', 'midtermAssignments', 'finalAssignments', 'pastExamPossession', 'grades', 'creditLevel', 'interestLevel', 'skillLevel', 'comments','createdAt')
         ->get();

        $reviewInfo = $reviews->map(function ($review) {

            $userName = Reviews::find($review->reviewId)->user->userName;
            $userId = Reviews::find($review->reviewId)->user->userId;
            $lectureName = Reviews::find($review->reviewId)->lecture->lectureName;

            return [
                'userId' => $userId,
                'userName' => $userName,
                'lectureName' => $lectureName,
                'reviewId' => $review->reviewId,
                'attendanceYear' => $review->attendanceYear,
                'attendanceConfirm' => $review->attendanceConfirm,
                'weeklyAssignments' => $review->weeklyAssignments,
                'midtermAssignments' => $review->midtermAssignments,
                'finalAssignments' => $review->finalAssignments,
                'pastExamPossession' => $review->pastExamPossession,
                'grades' => $review->grades,
                'comments' => $review->comments,
                'createdAt' => $review->createdAt,
                'skillLevel' => $review->skillLevel,
                'interestLevel' => $review->interestLevel,
                'creditLevel' => $review->creditLevel,
                'totalEvaluation' => ($review->skillLevel + $review->interestLevel + $review->creditLevel) / 3,
            ];
        });

        $data = [
            'userData'=>$userData,
            'reviewInfo'=>$reviewInfo,
        ];

        // JSON形式でデータを返す
        return response()->json($data);
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
    }

    public function logout()
    {
       Auth::logout();
       return back();

    //    return redirect('/');
    }
}
