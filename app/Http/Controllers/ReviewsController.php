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
use App\Models\ReviewLogs;
use App\Models\Lectures;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;

class ReviewsController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreReviewRequest $request)
  {
    // リクエストデータをログに記録
    Log::Debug($request);

    // 現在認証されているユーザーのIDを取得
    $userId = auth()->id();

    // ユーザーが存在しない場合にはエラーが出るようにする
    if ($userId == null) {
      return response()->json(['success' => false, 'message' => 'ユーザーが存在しません'], 401);
    }
    // セッションのユーザーIDとリクエストのユーザーIDが一致するかチェック
    else if ($userId != $request['userId']) {
      return response()->json(['success' => false, 'message' => 'ユーザーIDが一致しません'], 401);
    }

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
        return response()->json(['success' => false, 'message' => '既に同じユーザーと授業の組み合わせが存在します'], 400);
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

    ReviewLogs::query()->create([
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
      'status' => 'create',
      'createdAt' => now(),
    ]);

    // 登録処理を行う
    return response()->json(['success' => true,'message' => 'レビューの投稿に成功しました！']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    // reviewIdが取得できているかどうかの確認をする
    Log::Debug("id");
    Log::Debug($id);

    // レビューが存在するかどうかの確認
    $review = Reviews::find($id);

    ReviewLogs::query()->create([
      'lectureId' => $review->lectureId,
      'userId' => $review->userId,
      'attendanceYear' => $review->attendanceYear,
      'attendanceConfirm' => $review->attendanceConfirm,
      'weeklyAssignments' => $review->weeklyAssignments,
      'midtermAssignments' => $review->midtermAssignments,
      'finalAssignments' => $review->finalAssignments,
      'pastExamPossession' => $review->pastExamPossession,
      'grades' => $review->grades,
      'creditLevel' => $review->creditLevel,
      'interestLevel' => $review->interestLevel,
      'skillLevel' => $review->skillLevel,
      'comments' => $review->comments,
      'status' => 'delete',
      'createdAt' => now(),
    ]);

    // レビューの削除を行う
    if ($review) {
        $review->delete();
        Log::Debug("削除成功");
        return response()->json(['success' => true,'message' => '削除に成功しました']);
      } else {
        Log::Debug("削除失敗");
        return response()->json(['success' => false,'message' => '削除に失敗しました']);
    }

  }
}
