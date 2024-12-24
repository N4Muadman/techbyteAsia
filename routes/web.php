<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('aboutUs');
Route::get('/portfolios', [PagesController::class, 'portfolio'])->name('portfolio');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/send-contact', [PagesController::class, 'sendContact'])->name('sendContact');
Route::get('/recruitments', [PagesController::class, 'recruitment'])->name('recruitment');
Route::get('/recruitment/detail/{id}', [PagesController::class, 'recruitmentDetail'])->name('recruitmentDetail');
Route::post('/apply-recruitment/{id}', [PagesController::class, 'applyRecruitment'])->name('applyRecruitment');

Route::get('/news', [PagesController::class, 'news'])->name('news');
Route::get('/news/detail/{id}', [PagesController::class, 'newsDetail'])->name('newsDetail');


Route::get('admin/auth', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('admin/auth', [AuthController::class, 'login'])->name('login');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('is_admin')->prefix('admin')->group(function (){
    Route::get('/', function(){
        return view('admin.index');
    })->name('admin');

    Route::resource('portfolios', PortfolioController::class)->names('admin.portfolios');

    Route::get('feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::delete('feedback/{id}', [FeedbackController::class, 'delete'])->name('admin.feedback.delete');

    Route::resource('news', NewsController::class)->names('admin.news');
    Route::post('/upload-image', [NewsController::class, 'uploadImage'])->name('upload.image');

    Route::resource('quan-ly-vai-tro', RoleController::class)->names('roles');
    Route::resource('quan-ly-nhan-su', EmployeeController::class)->names('employees');
    Route::get('phan-quyen-cho-vai-tro', [RoleController::class, 'roleFunctionPermissions'])->name('roleFunctionPermissions');
    Route::post('gan-quyen-cho-vai-tro/{id}', [RoleController::class, 'assignPermissionsToRoles'])->name('set-role-permissions');
    Route::get('phan-vai-tro-nhan-vien', [EmployeeController::class, 'employeeListForPermission'])->name('employeeListForPermission');
    Route::post('phan-vai-tro-nhan-vien/{id}', [EmployeeController::class, 'permissionsForEmployee'])->name('permissionsForEmployee');

    Route::resource('banner-management', BannerController::class)->names('banner-managements');
});
