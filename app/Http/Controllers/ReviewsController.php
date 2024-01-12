<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Models\Reviews;
use App\Models\Lectures;
use Illuminate\Http\Request;

class ReviewsController extends Controller
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
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // リクエストデータをログに記録
    Log::Debug($request);

    // レクチャーidの取得
    $lecture_id = Lectures::where('lecture_name', $request['lecture_name'])
                  ->where('teacher_name', $request['teacher_name'])
                  ->value('lecture_id'); 

    Log::Debug("lecture_id");
    Log::Debug($lecture_id);

    // lecture_idが存在しない場合にはエラーが出るようにする
    
    // 同じuse_idかつ同じlecture_idの際にはエラーを返すようにする


    Reviews::query()->create([
      'lecture_id' => $lecture_id,
      'user_id' => $request['user_id'],
      'attendance_year' => $request['attendance_year'],
      'attendance_confirm' => $request['attendance_confirm'],
      'weekly_assignments' => $request['weekly_assignments'],
      'midterm_assignments' => $request['midterm_assignments'],
      'final_assignments' => $request['final_assignments'],
      'past_exam_possession' => $request['past_exam_possession'],
      'grades' => $request['grades'],
      'credit_level' => $request['credit_level'],
      'interest_level' => $request['interest_level'],
      'skill_level' => $request['skill_level'],
      'comments' => $request['comments'],
      'is_visible' => $request['is_visible'],
  ]);

  //   $validated = $request->validate([
  //     'lecture_id' => 'required|exists:lectures,lecture_id',
  //     'user_id' => 'required|exists:users,user_id',
  //     'attendance_year' => 'required|integer',
  //     'attendance_confirm' => 'required|string',
  //     'weekly_assignments' => 'required|string',
  //     'midterm_assignments' => 'required|string',
  //     'final_assignments' => 'required|string',
  //     'past_exam_possession' => 'required|string',
  //     'grades' => 'required|string|',
  //     'credit_level' => 'required|integer',
  //     'interest_level' => 'required|integer',
  //     'skill_level' => 'required|integer',
  //     'comments' => 'nullable|string|max:2048',
  //     'is_visible' => 'required|boolean'
  // ]);

  // $review = new Reviews($validated);

  // // レビューをデータベースに保存
  // $review->save();

    // ユーザーを前のページにリダイレクト
    return back();
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
}
