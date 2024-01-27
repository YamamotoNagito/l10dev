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
    $lectureId = Lectures::where('lectureName', $request['lectureName'])
                  ->where('teacherName', $request['teacherName'])
                  ->value('lectureId');

    Log::Debug("lectureId");
    Log::Debug($lectureId);

    // lectureIdが存在しない場合にはエラーが出るようにする
    if($lectureId == null){
      return response()->json(['success' => false,'message' => '授業が存在しません']);
    }

    Log::Debug("userId");
    Log::Debug($request['userId']);

    // 既に同じuserIdかつ同じlectureIdが存在するかチェック
    // あった際にはその旨を出力して登録できないようにする
    $existingRecord = Reviews::where('userId', $request['userId'])
                      ->where('lectureId', $lectureId)
                      ->value('lectureId');
    if($existingRecord){
        return response()->json(['success' => false, 'message' => '既に同じユーザーと授業の組み合わせが存在します']);
    }


    Reviews::query()->create([
      'lectureId' => $lectureId,
      'userId' => $request['userId'],
      'attendanceYear' => $request['attendanceYear'],
      'attendanceConfirm' => $request['attendanceConfirm'],
      'weeklyAssignments' => $request['weeklyAssignments'],
      'midtermAssignments' => $request['midtermAssignments'],
      'finalAssignments' => $request['finalAssignments'],
      'pastExamPossession' => $request['pastExamPossession'],
      'grades' => $request['grades'],
      'creditLevel' => $request['creditLevel'],
      'interestLevel' => $request['interestLevel'],
      'skillLevel' => $request['skillLevel'],
      'comments' => $request['comments'],
      'createdAt' => now(),
      'updatedAt' => now(),
  ]);

  //   $validated = $request->validate([
  //     'lectureId' => 'required|exists:lectures,lectureId',
  //     'userId' => 'required|exists:users,userId',
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

    // 登録処理を行う
    return response()->json(['success' => true,'message' => '授業を登録します']);
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
