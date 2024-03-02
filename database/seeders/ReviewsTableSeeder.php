<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('csv/reviews.csv');
        $handle = fopen($csvFile, 'r');

        if ($handle !== FALSE) {
            fgetcsv($handle); // CSVのヘッダー行をスキップ

            while (($data = fgetcsv($handle)) !== FALSE) {
                $validator = Validator::make([
                    'reviewId' => $data[0],
                    'lectureId' => $data[1],
                    'userId' => $data[2],
                    'attendanceYear' => $data[3],
                    'attendanceConfirm' => $data[4],
                    'weeklyAssignments' => $data[5],
                    'midtermAssignments' => $data[6],
                    'finalAssignments' => $data[7],
                    'pastExamPossession' => $data[8],
                    'grades' => $data[9],
                    'creditLevel' => $data[10],
                    'interestLevel' => $data[11],
                    'skillLevel' => $data[12],
                    'comments' => $data[13],
                ], [
                    'reviewId' => 'required|integer',
                    'lectureId' => 'required|integer',
                    'userId' => 'required|integer',
                    'attendanceYear' => 'required|integer',
                    'attendanceConfirm' => 'required|string',
                    'weeklyAssignments' => 'required|string',
                    'midtermAssignments' => 'required|string',
                    'finalAssignments' => 'required|string',
                    'pastExamPossession' => 'required|string',
                    'grades' => 'required|string',
                    'creditLevel' => 'required|integer',
                    'interestLevel' => 'required|integer',
                    'skillLevel' => 'required|integer',
                    'comments' => 'required|string',
                ]);

                if ($validator->fails()) {
                    Log::error('バリデーションエラー', [
                        'errors' => $validator->errors()
                    ]);
                    continue;
                }

                DB::table('reviews')->insert([
                    'reviewId' => $data[0],
                    'lectureId' => $data[1],
                    'userId' => $data[2],
                    'attendanceYear' => $data[3],
                    'attendanceConfirm' => $data[4],
                    'weeklyAssignments' => $data[5],
                    'midtermAssignments' => $data[6],
                    'finalAssignments' => $data[7],
                    'pastExamPossession' => $data[8],
                    'grades' => $data[9],
                    'creditLevel' => $data[10],
                    'interestLevel' => $data[11],
                    'skillLevel' => $data[12],
                    'comments' => $data[13],
                ]);
            }

            fclose($handle);
        } else {
            Log::error('CSVファイルを開けませんでした。', [
                'path' => $csvFile
            ]);
        }
    }
}
