<?php

use App\Http\Controllers\API\RecruitmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('recruitments', RecruitmentController::class);
Route::get('get-cvs/{id}', [RecruitmentController::class, 'getCVofRecruitment']);
Route::Delete('delete-application/{id}', [RecruitmentController::class, 'destroyApplication']);
Route::Post('upload-image-description', [RecruitmentController::class, 'uploadImageDescription']);

Route::get('download-cv/{path}', [RecruitmentController::class, 'downloadCv'])->where('path', '.*');
