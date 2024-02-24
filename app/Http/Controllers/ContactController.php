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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactFormRequest $request)
    {
        Log::Debug($request);

        // バリデーションルールを定義
        $validatedData = $request->validate([
            'name' => 'required|max:32', // 必須、32文字以内
            'email' => 'required|email', // 必須、Eメール形式
            'category' => 'required|string', // 必須、とりあえず文字列であることだけ検証
            'message' => 'required|string|2000', // 必須、2000文字以内
        ]);

        // バリデーションが通れば、データベースにデータを保存
        Contact::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'category' => $request['category'],
            'message' => $request['message'],
            'createdAt' => now(),
        ]);

        // 処理後、前のページにリダイレクト
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
