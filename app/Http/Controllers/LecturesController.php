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

        Log::Debug(gettype($selectedConditions));
        Log::Debug($selectedConditions);

        $lectureIds = DB::table('lectureDetailTimes')
                    ->leftJoin('lectureDetails', 'lectureDetailTimes.lectureDetailId', '=', 'lectureDetails.lectureDetailId')
                    ->leftJoin('lectures', 'lectureDetails.lectureId', '=', 'lectures.lectureId')
                    ->leftJoin('reviews', 'reviews.lectureId', '=', 'lectures.lectureId')
                    ->where(function ($query) use ($selectedConditions) {
                        foreach ($selectedConditions as $conditionKey => $conditionValue) {
                            switch ($conditionKey) {
                                case 'lectureName':
                                    Log::Debug("検索します");
                                    $query->where('lectures.lectureName', 'like', '%' . $conditionValue . '%');
                                    break;
                                case 'teacherName':
                                    $query->where('lectures.teacherName', 'like', '%' . $conditionValue . '%');
                                    break;
                                case 'location':
                                    $query->where('lectureDetails.location', $conditionValue);
                                    break;
                                case 'faculty':
                                    $query->where('lectureDetails.faculty', $conditionValue);
                                    break;
                                case 'category':
                                    $query->where('lectureDetails.category', $conditionValue);
                                    break;
                                case 'grade':
                                    $query->where('lectureDetails.grade', $conditionValue);
                                    break;

                                case 'term':
                                    $query->where('lectureDetailTimes.term', $conditionValue);
                                    break;
                                case 'dayOfWeek':
                                    $query->where('lectureDetailTimes.dayOfWeek', $conditionValue);
                                    break;
                                case 'timePeriod':
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

        // 最大100個
        $classDataList = $classDataList
                       ->sortByDesc('numberOfReviews')
                       ->take(100)
                       ->values();

        return $classDataList;
    }
}
