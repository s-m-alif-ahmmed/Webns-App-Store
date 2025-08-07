<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\Admin\Industry\IndustryController;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\App\AppController;
use App\Http\Controllers\Admin\App\AppUploadController;


Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/company/{company_code}',[HomeController::class, 'company'])->name('home.company');


//Error
Route::get('/404',[HomeController::class, 'error'])->name('404.error');

Route::middleware(['auth', 'verified'])->group(function (){

//    dashboard
    Route::get('/dashboard',[AdminDashboardController::class, 'dashboard'])->name('dashboard');

    //   Users
    Route::get('/admin/users',[UserController::class,'users'])->name('users');
    Route::get('/users/profile/{id}',[UserController::class,'profile'])->name('user.profile');
    Route::get('/users/profile/edit/{id}',[UserController::class,'profileEdit'])->name('profile.user.edit');
    Route::get('/user/change-password/{id}',[UserController::class,'password'])->name('users.password');
    Route::patch('/user/change-password/{id}',[UserController::class,'passwordChange'])->name('users.password.update');
    Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('users.edit');
    Route::patch('/user/update/{id}',[UserController::class,'update'])->name('users.update');
    Route::get('/user/detail/{id}',[UserController::class,'usersDetail'])->name('users.detail');
    Route::delete('/delete/user/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
    Route::get('/change-ban-status/{id}',[UserController::class,'changeBanStatus'])->name('change.ban.status');
    Route::get('/admin/404',[UserController::class,'dashboardError'])->name('error');

    //  Permission
    Route::resource('/user/permission',PermissionController::class);

    //  Industry
    Route::resource('/industry',IndustryController::class);
    Route::get('/change-industry-status/{id}',[IndustryController::class,'changeIndustryStatus'])->name('change.industry.status');

    //  Company
    Route::resource('/companies',CompanyController::class);
    Route::get('/change-company-status/{id}',[CompanyController::class,'changeCompanyStatus'])->name('change.company.status');

    //  apps
    Route::resource('/apps',AppController::class);
    Route::get('/change-apps-status/{id}',[AppController::class,'changeAppStatus'])->name('change.apps.status');

    //  app upload
    Route::resource('/app-upload',AppUploadController::class);
    Route::get('/change-apk-app-upload-status/{id}',[AppUploadController::class,'changeApkAppStatus'])->name('change.apk.app.upload.status');
    Route::get('/change-app-upload-status/{id}',[AppUploadController::class,'changeAppUploadStatus'])->name('change.app.upload.status');

//  company and app Dropdown
    Route::get('/getAppsByCompany', [AppUploadController::class, 'getAppByCompany']);


});

Route::middleware('auth')->group(function () {
//    Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //    Profile Photo manage
    Route::resource('/photo', ProfilePhotoController::class);
    Route::get('/photo/{id}', [ProfilePhotoController::class, 'show'])->name('profile.show');

});

require __DIR__.'/auth.php';
