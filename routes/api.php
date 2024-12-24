<?php

use App\Http\Controllers\API\RecruitmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('recruitments', RecruitmentController::class);
Route::get('get-cvs/{id}', [RecruitmentController::class, 'getCVofRecruitment']);
Route::get('download-cv/{path}', [RecruitmentController::class, 'downloadCv'])->where('path', '.*');;
