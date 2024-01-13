<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\LectureDetails;
use App\Models\Lectures;
use App\Models\Reviews;
use Illuminate\Validation\ValidationException;

class LectureDetailsController extends Controller
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

    // 講義コードの有無を出力
    public function hasLectureCode(Request $reqest)
    {
        // 講義コードの取得
        $lecture_code = "ABC123";

        // 講義idの取得
        $lecture_id = LectureDetails::where('lecture_code', $lecture_code)
                      ->value('lecture_id');;
        
        // 講義idの有無を判別
        if($lecture_id == null){
            return response()->json(['success' => false,'message' => '講義コードが存在しません']);
        }else{
            return response()->json(['success' => true, 'lecture_id' => $lecture_id, 'message' => '講義コードが存在します']);
        }
        
    }

    // 講義コードから授業情報の出力
    public function search(Request $reqest)
    {
        // 講義コードの取得
        $lecture_code = "ABC123";

        // 講義idの取得
        $lecture_id = LectureDetails::where('lecture_code', $lecture_code)
                      ->value('lecture_id');;
                      
        // Lecturesテーブルの講義idを基に授業名・担当教員名の取得
        $lecture_info = Lectures::where('lecture_id', $lecture_id)
                    // ->value('lecture_name');
                    ->select('lecture_id', 'lecture_name', 'teacher_name')
                    ->get();
        
        // 授業名・主担当教員名の出力
        if ($lecture_info) {
            $lecture_id = $lecture_info->lecture_id;
            $lecture_name = $lecture_info->lecture_name;
            $teacher_name = $lecture_info->teacher_name;            
        }

        // Reviewsテーブルのlecture_idを基にレビュー一覧の取得
        // 'midterm_assignments' => $request['midterm_assignments'],
        // 'final_assignments' => $request['final_assignments'],
        // 'past_exam_possession' => $request['past_exam_possession'],
        // 'grades' => $request['grades'],
        // 'credit_level' => $request['credit_level'],
        // 'interest_level' => $request['interest_level'],
        // 'skill_level' => $request['skill_level'],
        // 'comments' => $request['comments'],
        // 'is_visible' => $request['is_visible'],
        $review_info = Reviews::where('lecture_id', $lecture_id)
                    // ->value('lecture_name');
                    ->select('attendance_year', 'attendance_confirm', 'weekly_assignments', 'midterm_assignments', 'final_assignments')
                    // ->select('attendance_year', 'attendance_confirm', 'weekly_assignments', 'midterm_assignments', 'final_assignments', '', '', '', '')
                    ->get();

        Log::Debug($review_info);
        Log::Debug(response()->json($review_info));

        // if ($review_info) {
        //     $attendance_year = $review_info->attendance_year;
        //     $attendance_confirm = $review_info->attendance_confirm;
        //     $weekly_assignments = $review_info->weekly_assignments;
            
        //     // ここで取得した情報を使って何かしらの処理を行う
        //     Log::Debug("レビュー情報");
        //     Log::Debug($attendance_year);
        //     Log::Debug($attendance_confirm);
        //     Log::Debug($weekly_assignments);
        // }

        // return response()->json(['success' => true, 'lecture_name' => $lecture_name, 'teacher_name' => $teacher_name]);
        return response()->json($review_info);
    }
}
