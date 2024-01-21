<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        // Lectureテーブル(授業名・先生名)の情報
        $lectureName = "";
        $teatureName = "";

        // LectureDetailsテーブルの情報
        $location = "";
        $faculty = "";
        $category = "";
        $grade = "";

        // LectureDetailTimesテーブルの情報
        $term = "";
        $dayOfWeek = "";
        $timePeriod = "";
        
        // Reviewテーブルの情報
        $totalEvaluationMin = "";
        $totalEvaluationMax = "";
        $creditLevelMin = "";
        $creditLevelMax = "";
        $interestLevelMin = "";
        $interestLevelMax = "";
        $skillLevelMin = "";
        $skillLevelMin = "";

        // 授業名・担当教員名からLectureIdを取得する

        $lectureIds = DB::table('lectureDetailTimes')
                    ->join('lectureDetails', 'lectureDetailTimes.lectureDetailId', '=', 'lectureDetails.id')
                    ->join('lectures', 'lectureDetails.lectureId', '=', 'lectures.id')
                    ->where(function ($query) use ($selectedConditions) {
                        foreach ($selectedConditions as $conditionKey => $conditionValue) {
                            switch ($conditionKey) {
                                case 'year':
                                    $query->where('lectureDetailTimes.year', $conditionValue);
                                    break;
                                case 'term':
                                    $query->where('lectureDetailTimes.term', $conditionValue);
                                    break;
                                case 'faculty':
                                    $query->where('lectureDetails.faculty', $conditionValue);
                                    break;
                                // 他の条件に対する処理...
                            }
                        }
                    })
                    ->pluck('lectures.id');

    }
}
