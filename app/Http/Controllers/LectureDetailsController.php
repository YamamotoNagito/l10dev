<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\LectureDetails;
use App\Models\LectureDetailTimes;
use App\Models\Lectures;
use App\Models\Reviews;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


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
    public function hasLectureCode(Request $request)
    {
        // 講義コードの取得
        $lectureCode = "ABC123";
        // $lectureCode = $request['lectureCode'];

        // 講義idの取得
        $lectureId = LectureDetails::where('lectureCode', $lectureCode)
                      ->value('lectureId');
        
        // 講義idの有無を判別
        if($lectureId == null){
            return response()->json(['success' => false,'message' => '講義コードが存在しません']);
        }else{
            return response()->json(['success' => true, 'lectureId' => $lectureId, 'message' => '講義コードが存在します']);
        }
        
    }

    // 講義コードから授業情報の出力
    public function searchByLectureCode(Request $request)
    {
        // 講義コードの取得
        $lectureCode = "ABC123";

        // 講義コードに概要する情報を取得する
        // LectureDetailsテーブルからすべての情報を取得
        $lectureDetail = LectureDetails::where('lectureCode', $lectureCode)->first();
        Log::Debug("lectureDetail");
        Log::Debug($lectureDetail);

        // $lectureDetail["time"] = ["おはよう","おやすみ"];
        // Log::Debug("lectureDetail");
        // Log::Debug($lectureDetail);

        // 講義コードの取得
        $lectureId = $lectureDetail->lecture->lectureId;
        Log::Debug("lectureId");
        Log::Debug($lectureId);
        
        // ⓵Lecutesモデルから講義IDが一致する授業名を取得する
        $lecture = Lectures::where("lectureId",$lectureId)->first(["lectureName","teacherName"]);
        Log::Debug("lecture");
        Log::Debug($lecture);

        // ⓶講義IDを検索条件として、LectureDetailsの一覧の取得
        // 例：LecturesモデルからlectureIdが1のデータとそのLectureDetailTimesの一覧を取得する
        // $lectureDetail = Lectures::with('lectureDetails')->find($lectureId);
        // Log::Debug("lectureDetails");
        // Log::Debug($lectureDetail);
        // Log::Debug(json_encode($lecture, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // LectureDetailsテーブルからlectureIdに紐づく一覧を取得
        $lectureDetail = LectureDetails::where('lectureId', $lectureId)->get(["lectureDetailId","lectureCode","syllabusUrl","location","faculty","category","grade"]);

        // LectureDetailTimesテーブルからlectureIdに紐づく一覧を取得
        // $lectureDetailTimes = LectureDetailTimes::whereIn('lectureDetailId', $lectureDetails->pluck('lectureDetailId'))->get();

        // LectureDetailsのlectureDetailIdに基づいてLectureDetailTimesの一覧を取得
        $lectureDetailTime = $lectureDetail->map(function ($lectureDetail) {
            $times = LectureDetailTimes::where('lectureDetailId', $lectureDetail->lectureDetailId)->get(["year","term","dayOfWeek","timePeriod"]);
            $lectureDetail["lectureDetailTimes"] = $times;
            // return $lectureDetail;
        });

        // Reviewsテーブルのlecture_idを基にレビュー一覧の取得
        $review_info = Reviews::where('lectureId', $lectureId)
                    // ->select('attendance_year', 'attendance_confirm', 'weekly_assignments', 'midterm_assignments', 'final_assignments')
                    ->select('attendanceYear', 'attendanceConfirm', 'weeklyAssignments', 'midtermAssignments', 'finalAssignments', 'pastExamPossession', 'grades', 'creditLevel', 'interestLevel', 'skillLevel', 'comments')
                    ->get();

        // 合計評価の計算処理
        // 講義コードからレビュー一覧を取得
        // その中で合計処理をはしらせる
        $averageCreditLevel = Reviews::where('lectureId', $lectureId)
                            ->select('creditLevel')
                            ->average('creditLevel');
        $averageinterestLevel = Reviews::where('lectureId', $lectureId)
                            ->select('interestLevel')
                            ->average('interestLevel');
        $averageskillLevel = Reviews::where('lectureId', $lectureId)
                            ->select('skillLevel')
                            ->average('skillLevel');

        // 

        $classDetailData = [
            'classInformationData' => [
            // 'classInformationData' => [
                'lectureName' => $lecture->lectureName,
                'teacherName' => $lecture->teacherName,
                // 'lectureDetails' => $lectureDetails,
                'classInformationDataList' => [
                    $lectureDetail,
                    // $lectureDetail->toArray(),
                    // "lectureDetailTimes" => [
                    //     // $times,
                    // ]
                ],
            ],
            // "info_a"=>"a",
            // "info_b"=>"b",
            // "info_c"=>"c",

                'classRadarChartData' => [
                'creditLevel' => $averageCreditLevel,
                'interestLevel' => $averageinterestLevel,
                'skillLevel' => $averageskillLevel,
            ],
            'classBarGraphData' => [
                'grades': {
                    // S: 20,
                    // A: 30,
                    // B: 30,
                    // C: 30,
                    // D: 80,
                },
                'attendanceConfirm': {
                //   everyday: 1,
                //   sometimes: 20,
                //   none: 200,
                },
                'pastExamPossesion': {
                //   yes: 20,
                //   no: 300,
                },
                'weeklyAssignments': {
                //   yes: 20,
                //   no: 300,
                },
                'midtermAssignments': {
                //   yes: 300,
                //   no: 1,
                },
                'finalAssignments': {
                //   yes: 300,
                //   no: 1,
                },
            ],
            'reviewDataList' => $review_info->toArray(),
        ];

        // $classDetailData = collect($classDetailData)->mapWithKeys(function ($value, $key) {
        //     if (is_array($value) && !empty($value) && $this->is_assoc($value)) {
        //         // 配列が連想配列の場合、再帰的に処理
        //         return [Str::camel($key) => $this->convertKeysToCamelCase($value)];
        //     } else {
        //         // それ以外の場合、単純に変換
        //         return [Str::camel($key) => $value];
        //     }
        // })->all();

        // 取得したデータをJSON形式でレスポンス
        return response()->json(
            $classDetailData
            // $camelCaseData
        );
        return response()->json($classDetailData);
    }

}
