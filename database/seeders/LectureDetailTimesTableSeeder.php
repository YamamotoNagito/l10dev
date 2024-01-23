<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LectureDetailTimesTableSeeder extends Seeder
{
  public function run()
  {
      $csvFile = database_path('csv/lectureDetailTimes.csv');
      $handle = fopen($csvFile, 'r');

      if ($handle !== FALSE) {
          fgetcsv($handle); // CSVヘッダーを読み飛ばす

          while (($data = fgetcsv($handle)) !== FALSE) {
              $validator = Validator::make([
                  'lectureDetailTimeId' => $data[0],
                  'lectureDetailId' => $data[1],
                  'year' => $data[2],
                  'term' => $data[3],
                  'dayOfWeek' => $data[4],
                  'timePeriod' => $data[5],
              ], [
                  'lectureDetailTimeId' => 'required|integer',
                  'lectureDetailId' => 'required|integer',
                  'year' => 'required|integer',
                  'term' => 'required|string|max:255',
                  'dayOfWeek' => 'required|string|max:255',
                  'timePeriod' => 'required|string|max:255',
              ]);

              if ($validator->fails()) {
                  Log::error('バリデーションエラー', [
                      'errors' => $validator->errors()
                  ]);
                  continue;
              }

              DB::table('lectureDetailTimes')->insert([
                  'lectureDetailTimeId' => $data[0],
                  'lectureDetailId' => $data[1],
                  'year' => $data[2],
                  'term' => $data[3],
                  'dayOfWeek' => $data[4],
                  'timePeriod' => $data[5],
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
