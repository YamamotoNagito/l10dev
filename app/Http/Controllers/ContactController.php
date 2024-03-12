<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactFormRequest $request)
    {
        Log::Debug($request);

        // バリデーションが通れば、データベースにデータを保存
        Contact::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'category' => $request['category'],
            'message' => $request['message'],
            'createdAt' => now(),
        ]);

       // 成功メッセージを返す
        return response()->json(['success' => true, 'message' => 'お問い合わせを受け付けました。']);
    }
}
