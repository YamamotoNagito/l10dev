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
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    // 新規登録時の処理
    public function create(UserCreateRequest $request)
    {
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

        Auth::loginUsingId($user->userId);

        return response()->json(['success' => true,'id' => $user->userId,'role' => $user->getRoleNames()]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userId = auth()->id();

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

    public function update(UserEditRequest $request)
    {
          $userId = auth()->id();
          $user = User::find($userId);
          $user->update($request->all());
    }

    public function initialValues()
    {
        $userId = auth()->id();
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
}
