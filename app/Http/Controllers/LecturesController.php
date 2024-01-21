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
use Illuminate\Support\Facades\DB;

class LecturesController extends Controller
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

    // 講義コードから授業情報の出力
    public function searchByConditions(Request $request)
    {
        // リクエストの中身一覧を見てみる

        Log::Debug($request);

        $selectedConditions = $request;

        // $selectedConditions=[

        //     // Lectureテーブル(授業名・先生名)の情報
        //     "lectureName" => "プログラ",
        //     "teacherName" => "",

        //     // // LectureDetailsテーブルの情報
        //     // location => "",
        //     // faculty => "",
        //     // category => "",
        //     // grade => "",

        //     // // LectureDetailTimesテーブルの情報
        //     // term => "",
        //     // dayOfWeek => "",
        //     // timePeriod => "",
            
        //     // // Reviewテーブルの情報
        //     // totalEvaluationMin => "",
        //     // totalEvaluationMax => "",
        //     // creditLevelMin => "",
        //     // creditLevelMax => "",
        //     // interestLevelMin => "",
        //     // interestLevelMax => "",
        //     // skillLevelMin => "",
        //     // skillLevelMin => "",
        // ];
        
        // // Lectureテーブル(授業名・先生名)の情報
        // $lectureName = "";
        // $teatureName = "";

        // // LectureDetailsテーブルの情報
        // $location = "";
        // $faculty = "";
        // $category = "";
        // $grade = "";

        // // LectureDetailTimesテーブルの情報
        // $term = "";
        // $dayOfWeek = "";
        // $timePeriod = "";
        
        // // Reviewテーブルの情報
        // $totalEvaluationMin = "";
        // $totalEvaluationMax = "";
        // $creditLevelMin = "";
        // $creditLevelMax = "";
        // $interestLevelMin = "";
        // $interestLevelMax = "";
        // $skillLevelMin = "";
        // $skillLevelMin = "";

        $lectureIds = DB::table('lectureDetailTimes')
                    ->join('lectureDetails', 'lectureDetailTimes.lectureDetailId', '=', 'lectureDetails.lectureDetailId')
                    ->join('lectures', 'lectureDetails.lectureId', '=', 'lectures.lectureId')
                    ->join('reviews', 'reviews.lectureId', '=', 'lectures.lectureId')
                    ->where(function ($query) use ($selectedConditions) {
                        foreach ($selectedConditions as $conditionKey => $conditionValue) {
                            switch ($conditionKey) {
                                case 'lectureName':
                                    Log::Debug("検索します");
                                    // $query->where('lectures.lectureName', $conditionValue);
                                    
                                    $query->where('lectures.lectureName', 'like', '%' . $conditionValue . '%');
                                    // $query->where('lectureDetais.', $conditionValue);
                                    // $query->where('lectureDetailTimes.', $conditionValue);
                                    break;
                                case 'teacherName':
                                    $query->where('lectures.teacherName', 'like', '%' . $conditionValue . '%');
                                    // $query->where('lectureDetais.', $conditionValue);
                                    // $query->where('lectureDetailTimes.', $conditionValue);
                                    break;

                                case 'location':
                                    // $query->where('lectures.', $conditionValue);
                                    $query->where('lectureDetais.location', $conditionValue);
                                    // $query->where('lectureDetailTimes.', $conditionValue);
                                    break;
                                case 'faculty':
                                    // $query->where('lectures.', $conditionValue);
                                    $query->where('lectureDetais.faculty', $conditionValue);
                                    // $query->where('lectureDetailTimes.', $conditionValue);
                                    break;
                                case 'category':
                                    // $query->where('lectures.', $conditionValue);
                                    $query->where('lectureDetais.category', $conditionValue);
                                    // $query->where('lectureDetailTimes.', $conditionValue);
                                    break;
                                case 'grade':
                                    // $query->where('lectures.', $conditionValue);
                                    $query->where('lectureDetais.grade', $conditionValue);
                                    // $query->where('lectureDetailTimes.', $conditionValue);
                                    break;

                                case 'term':
                                    // $query->where('lectures.', $conditionValue);
                                    // $query->where('lectureDetais.', $conditionValue);
                                    $query->where('lectureDetailTimes.term', $conditionValue);
                                    break;
                                case 'dayOfWeek':
                                    // $query->where('lectures.', $conditionValue);
                                    // $query->where('lectureDetais.', $conditionValue);
                                    $query->where('lectureDetailTimes.dayOfWeek', $conditionValue);
                                    break;
                                case 'timePeriod':
                                    // $query->where('lectures.', $conditionValue);
                                    // $query->where('lectureDetais.', $conditionValue);
                                    $query->where('lectureDetailTimes.timePeriod', $conditionValue);
                                    break;


                                case 'totalEvaluationMin':
                                    $query->groupBy('lectures.lectureId')  
                                          ->having(DB::raw('(AVG(reviews.skillLevel) + AVG(reviews.interestLevel) + AVG(reviews.creditLevel)) / 3'), '>=', $conditionValue);
                                    break;
                                    
                                case 'totalEvaluationMax':
                                    $query->groupBy('lectures.lectureId')  
                                          ->having(DB::raw('(AVG(reviews.skillLevel) + AVG(reviews.interestLevel) + AVG(reviews.creditLevel)) / 3'), '<', $conditionValue);
                                    break;

                                case 'creditLevelMin':
                                    $query->groupBy('lectures.lectureId')  
                                          ->having(DB::raw('AVG(reviews.creditLevel)'), '>=', $conditionValue);
                                    break;
                                    
                                case 'creditLevelMax':
                                    $query->groupBy('lectures.lectureId')  
                                          ->having(DB::raw('AVG(reviews.creditLevel)'), '<', $conditionValue);
                                    break;
                                          
                                case 'interestLevelMin':
                                    $query->groupBy('lectures.lectureId')  
                                            ->having(DB::raw('AVG(reviews.interestLevel)'), '>=', $conditionValue);
                                    break;
                                case 'interestLevelMax':
                                    $query->groupBy('lectures.lectureId')  
                                            ->having(DB::raw('AVG(reviews.interestLevel)'), '<', $conditionValue);
                                    break;
                                            
                                case 'skillLevelMin':
                                    $query->groupBy('lectures.lectureId')  
                                            ->having(DB::raw('AVG(reviews.skillLevel)'), '>=', $conditionValue);
                                            break;
                                case 'skillLevelMax':
                                    $query->groupBy('lectures.lectureId')  
                                            ->having(DB::raw('AVG(reviews.skillLevel)'), '<', $conditionValue);
                                    break;
                            }
                        }
                    })
                    ->distinct()
                    ->pluck('lectures.lectureId');
                    

        Log::Debug($lectureIds);
        
        return $lectureIds;
    }
}
