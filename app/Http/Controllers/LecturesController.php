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

        // 認証されているユーザーのIDを取得
        $loginUserId = auth()->id();

        $selectedConditions = $request->input();

        Log::Debug(gettype($selectedConditions));
        Log::Debug($selectedConditions);

        $lectureIdsQuery = DB::table('lectureDetailTimes')
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
                            }
                        }
                    })

                    ->groupBy('lectures.lectureId');

        // 総合評価の条件がある場合にのみ having を適用
        if (isset($selectedConditions['totalEvaluationMin'])) {
            $lectureIdsQuery->having(DB::raw('(AVG(reviews.skillLevel) + AVG(reviews.interestLevel) + AVG(reviews.creditLevel)) / 3'), '>=', $selectedConditions['totalEvaluationMin']);
        }

        if (isset($selectedConditions['totalEvaluationMax'])) {
            $lectureIdsQuery->having(DB::raw('(AVG(reviews.skillLevel) + AVG(reviews.interestLevel) + AVG(reviews.creditLevel)) / 3'), '<=', $selectedConditions['totalEvaluationMax']);
        }

        if (isset($selectedConditions['creditLevelMin'])) {
            $lectureIdsQuery->having(DB::raw('AVG(reviews.creditLevel)'), '>=', $selectedConditions['creditLevelMin']);
        }

        if (isset($selectedConditions['creditLevelMax'])) {
            $lectureIdsQuery->having(DB::raw('AVG(reviews.creditLevel)'), '<=', $selectedConditions['creditLevelMax']);
        }

        if (isset($selectedConditions['interestLevelMin'])) {
            $lectureIdsQuery->having(DB::raw('AVG(reviews.interestLevel)'), '>=', $selectedConditions['interestLevelMin']);
        }

        if (isset($selectedConditions['interestLevelMax'])) {
            $lectureIdsQuery->having(DB::raw('AVG(reviews.interestLevel)'), '<=', $selectedConditions['interestLevelMax']);
        }

        if (isset($selectedConditions['skillLevelMin'])) {
            $lectureIdsQuery->having(DB::raw('AVG(reviews.skillLevel)'), '>=', $selectedConditions['skillLevelMin']);
        }

        if (isset($selectedConditions['skillLevelMax'])) {
            $lectureIdsQuery->having(DB::raw('AVG(reviews.skillLevel)'), '<=', $selectedConditions['skillLevelMax']);
        }
        $lectureIds = $lectureIdsQuery->pluck('lectures.lectureId');
        $classData = Lectures::whereIn('lectureId', $lectureIds)
        ->with(['reviews' => function($query) {
            $query->select(
                'lectureId',
                DB::raw('SUM(skillLevel) as totalSkillLevel'),
                DB::raw('SUM(interestLevel) as totalInterestLevel'),
                DB::raw('SUM(creditLevel) as totalCreditLevel'),
                DB::raw('COUNT(*) as reviewCount')
            )->groupBy('lectureId');
        }])
        ->get();

        // ユーザーが投稿した講義IDの一覧を取得
        $lectureIdsByUserId = Reviews::where('userId', $loginUserId)->pluck('lectureId')->unique()->toArray();
        Log::Debug($lectureIdsByUserId);


        $classDataList = $classData->map(function ($item) use ($lectureIdsByUserId) {

            $alreadyReviewed = false;
            $alreadyReviewed = in_array($item->lectureId, $lectureIdsByUserId);

            // レビューデータの処理
            $reviewData = $item->reviews->first(); // Eager Loadingにより取得したレビューデータを使用

            $totalEvaluation = 0;
            if ($reviewData && $reviewData->reviewCount > 0) {
                // 平均を計算
                $totalEvaluation = ($reviewData->totalSkillLevel + $reviewData->totalInterestLevel + $reviewData->totalCreditLevel) / $reviewData->reviewCount / 3;
            }

            // レビュー済みかどうかを判定する
            if(in_array($item->lectureId, $lectureIdsByUserId)){
                $alreadyReviewed = true;
                // Log::Debug("レビュー済みです");
            }

            return [
                'lectureId' => $item->lectureId,
                'alreadyReviewed' => $alreadyReviewed,
                'lectureName' => $item->lectureName,
                'lectureCode' => $item->lectureCode,
                'teacherName' => $item->teacherName,
                'totalEvaluation' => $totalEvaluation,
                'numberOfReviews' => $reviewData ? $reviewData->reviewCount : 0,
            ];
        });

        // 最大100個
        $classDataList = $classDataList
                       ->sortByDesc('numberOfReviews')
                       ->take(100)
                       ->values();

        return $classDataList;
    }
}
