<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 情報を登録
Route::get('sinup',[TodoController::class,'index']);
Route::post('sinup',[TodoController::class,'post']);
// 新規登録画面
Route::get('sin',[TodoController::class,'sin']);
Route::post('sin',[TodoController::class,'register']);
// 管理者画面
Route::get('data',[TodoController::class,'data']);
// 更新ページ
Route::get('update/{id}',[TodoController::class,'update']);
ROute::post('update/{id}',[TodoController::class,'edit']);
// 削除ページ
Route::get('delete/{id}',[TodoController::class,'delete']);
Route::post('delete/{id}',[TodoController::class,'remove']);
// ログイン画面
Route::get('login',[TodoController::class,'login']);
Route::post('login',[TodoController::class,'log']);
// 検索ページ
Route::get('search/{id}',[TodoController::class,'search']);
// postからの検索画面作成
Route::get('research',[TodoController::class,'research']);
Route::post('research',[TodoController::class,'research2']);