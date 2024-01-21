<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LecturesTableSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('csv/lectures.csv');
        $handle = fopen($csvFile, 'r');

        if ($handle !== FALSE) {

            fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== FALSE) {
                $validator = Validator::make([
                    'lectureId' => $data[0],
                    'lectureName' => $data[1],
                    'teacherName' => $data[2],
                ], [
                    'lectureId' => 'required|integer',
                    'lectureName' => 'required|string',
                    'teacherName' => 'required|string',
                ]);

                if ($validator->fails()) {
                    Log::error('バリデーションエラー', [
                        'errors' => $validator->errors()
                    ]);
                    continue;
                }

                DB::table('lectures')->insert([
                    'lectureId' => $data[0],
                    'lectureName' => $data[1],
                    'teacherName' => $data[2],
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
