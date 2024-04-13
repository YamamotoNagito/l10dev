<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LectureDetailsSeeder extends Seeder
{
  public function run()
  {
    $csvFile = database_path('csv/lectureDetails.csv');
    $handle = fopen($csvFile, 'r');

    if ($handle !== FALSE) {
      fgetcsv($handle); // CSVヘッダーを読み飛ばす

      while (($data = fgetcsv($handle)) !== FALSE) {
        $validator = Validator::make([
          'lectureDetailId' => $data[0],
          'lectureId' => $data[1],
          'lectureCode' => $data[2],
          'syllabusUrl' => $data[3],
          'location' => $data[4],
          'faculty' => $data[5],
          'category' => $data[6],
          'grade' => $data[7],
        ], [
          'lectureDetailId' => 'required|integer',
          'lectureId' => 'required|integer',
          'lectureCode' => 'required|string|max:255',
          'syllabusUrl' => 'required',
          'location' => 'required|string',
          'faculty' => 'required|string',
          'category' => 'required|string',
          'grade' => 'required|string',
        ]);

        if ($validator->fails()) {
          Log::error('バリデーションエラー', [
            'errors' => $validator->errors()
          ]);
          continue;
        }

        DB::table('lectureDetails')->insert([
          'lectureDetailId' => $data[0],
          'lectureId' => $data[1],
          'lectureCode' => $data[2],
          'syllabusUrl' => $data[3],
          'location' => $data[4],
          'faculty' => $data[5],
          'category' => $data[6],
          'grade' => $data[7],
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
