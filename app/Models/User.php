<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles; // 権限の更新に必要

    // 主キーを 'userId' に設定する例
    protected $primaryKey = 'userId';

    public $timestamps = false; // created_atとupdated_atを無効にする

    // ユーザーの最終ログイン日時を更新するメソッド
    public function updateLastLogin()
    {
        $this->update(['lastLoginAt' => now()]);
    }

    public function updatecreatedAt()
    {
        $this->update(['createdAt' => now()]);
    }

    public function updateUpdatedAt()
    {
        $this->update(['updatedAt' => now()]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userName',
        'userEmail',
        'password',
        'universityName',
        'category',
        'faculty',
        'department',
        'admissionYear',
        'isActive',
        'createdAt',
        'updatedAt',
        'lastLoginAt',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
