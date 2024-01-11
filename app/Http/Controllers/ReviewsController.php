<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
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
  public function store(Request $request)
  {
    // リクエストデータをログに記録
    Log::Debug($request);

    $validated = $request->validate([
      'lecture_id' => 'required|exists:lectures,lecture_id',
      'user_id' => 'required|exists:users,user_id',
      'attendance_year' => 'required|integer',
      'attendance_confirm' => 'required|string',
      'weekly_assignments' => 'required|string',
      'midterm_assignments' => 'required|string',
      'final_assignments' => 'required|string',
      'past_exam_possession' => 'required|string',
      'grades' => 'required|string|',
      'credit_level' => 'required|integer',
      'interest_level' => 'required|integer',
      'skill_level' => 'required|integer',
      'comments' => 'nullable|string|max:2048',
      'is_visible' => 'required|boolean'
  ]);

  $review = new Reviews($validated);

  // レビューをデータベースに保存
  $review->save();
  
    // ユーザーを前のページにリダイレクト
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
