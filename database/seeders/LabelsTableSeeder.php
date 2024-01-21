<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LabelsTableSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('csv/labels.csv');
        $handle = fopen($csvFile, 'r');

        if ($handle !== FALSE) {
            fgetcsv($handle); // CSVヘッダーを読み飛ばす

            while (($data = fgetcsv($handle)) !== FALSE) {
                $validator = Validator::make([
                    'labelId' => $data[0],
                    'labelName' => $data[1],
                ], [
                    'labelId' => 'required|integer',
                    'labelName' => 'required|string|max:40',
                ]);

                if ($validator->fails()) {
                    Log::error('バリデーションエラー', [
                        'errors' => $validator->errors()
                    ]);
                    continue;
                }

                DB::table('labels')->insert([
                    'labelId' => $data[0],
                    'labelName' => $data[1],
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
