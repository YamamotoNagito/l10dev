<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LectureLabelsTableSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('csv/lectureLabels.csv');
        $handle = fopen($csvFile, 'r');

        if ($handle !== FALSE) {
            fgetcsv($handle); // CSVヘッダーを読み飛ばす

            while (($data = fgetcsv($handle)) !== FALSE) {
                $validator = Validator::make([
                    'lectureId' => $data[0],
                    'labelId' => $data[1],
                ], [
                    'lectureId' => 'required|integer',
                    'labelId' => 'required|integer',
                ]);

                if ($validator->fails()) {
                    Log::error('バリデーションエラー', [
                        'errors' => $validator->errors()
                    ]);
                    continue;
                }

                DB::table('lectureLabels')->insert([
                    'lectureId' => $data[0],
                    'labelId' => $data[1],
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
