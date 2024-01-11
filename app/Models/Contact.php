<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    
    // public $timestamps = true;
    public $timestamps = false; // 自動更新を無効にする

    protected $fillable = [
        'name',
        'email',
        'category',
        'message',
        'created_at',
    ];

}
