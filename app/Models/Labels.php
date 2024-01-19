<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Labels extends Model
{
    use HasFactory;

    protected $table = 'labels'; // テーブル名を指定

    protected $primaryKey = 'labelId'; // プライマリキーのカラム名を指定

    public $timestamps = false; // created_atとupdated_atを無効にする

    protected $fillable = [
        'labelName',
        // 他のカラムを追加
    ];

}
