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

    public function getLectureInfo(){
        $lectureInfo = Lectures::select("lectureName","teacherName")->get();
        // Log::Debug($lectureInfo);

        return $lectureInfo;
    }

    // public function arrayToObject($array) {
    //     if (!is_array($array)) {
    //         return $array;
    //     }
    
    //     $object = new \stdClass();
    //     foreach ($array as $key => $value) {
    //         $object->$key = arrayToObject($value);
    //     }
    
    //     return $object;
    // }

    // 講義コードから授業情報の出力
    public function searchByConditions(Request $request)
    {
        // リクエストの中身一覧を見てみる

        Log::Debug($request);

        $selectedConditions = $request->input();

        // Log::Debug($this->arrayToObject($selectedConditions));

        // $selectedConditions = array_filter($selectedConditions, function ($value) {
        //     return $value !== NULL;
        // });

        // if (is_array($request)) {
        //     // NULLの値を持つ要素を削除
        //     $selectedConditions = array_filter($request, function ($value) {
        //         return $value !== NULL;
        //     });
        
        //     // 結果を表示または利用
        //     print_r($filteredRequest);
        // } else {
        //     // エラー処理または適切な処理を行う
        //     echo "Invalid request format";
        // }

        // Log::Debug(gettype($selectedConditions));
        // Log::Debug($selectedConditions);

        // $selectedConditions=[

        //     // Lectureテーブル(授業名・先生名)の情報
            // "lectureName" => "プログラ",
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

        Log::Debug(gettype($selectedConditions));
        Log::Debug($selectedConditions);
        
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
                    ->leftJoin('lectureDetails', 'lectureDetailTimes.lectureDetailId', '=', 'lectureDetails.lectureDetailId')
                    ->leftJoin('lectures', 'lectureDetails.lectureId', '=', 'lectures.lectureId')
                    ->leftJoin('reviews', 'reviews.lectureId', '=', 'lectures.lectureId')
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

        // $lectureIds からデータを取得する処理を実装
        $classData = Lectures::whereIn('lectureId', $lectureIds)->get();
        $classDataList = $classData->map(function ($item) {

            $reviewData = DB::table('reviews')
                        ->where('lectureId', $item->lectureId)
                        ->select(
                            DB::raw('SUM(skillLevel) as totalSkillLevel'),
                            DB::raw('SUM(interestLevel) as totalInterestLevel'),
                            DB::raw('SUM(creditLevel) as totalCreditLevel'),
                            DB::raw('COUNT(*) as reviewCount')
                        )
                        ->first();

            // Log::Debug($reviewData->reviewCount);

            if ($reviewData->reviewCount > 0){
                // 平均を計算
                $totalEvaluation = ($reviewData->totalSkillLevel + $reviewData->totalInterestLevel + $reviewData->totalCreditLevel) / $reviewData->reviewCount / 3;
            }else{
                $totalEvaluation = 0;
            }
            
            return [
                'lectureId' => $item->lectureId,
                'lectureName' => $item->lectureName,
                'lectureCode' => $item->lectureCode,
                'teacherName' => $item->teacherName,
                'totalEvaluation' => $totalEvaluation,
                'numberOfReviews' => $reviewData->reviewCount,
            ];
        });

        Log::Debug($lectureIds);
        // Log::Debug($classDataList);
        
        return $classDataList;
    }
}
