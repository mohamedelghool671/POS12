<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SaleInfoController;
use App\Http\Controllers\Admin\OrderBoardController;
use App\Http\Controllers\Admin\RoleChangeController;
use App\Http\Controllers\Admin\AdminDashboardController;


//admin
Route::group(['prefix' => 'admin' , 'middleware' => ['auth','admin']], function(){
    Route::get('/home', [AdminDashboardController::class, 'index'])->name('adminDashboard');

    //category
    Route::resource('category', CategoryController::class);
    //product
    Route::resource('product', ProductController::class);

    //payment
    Route::resource('payment', PaymentController::class);

    //password
    Route::prefix('password')->group(function(){
        Route::get('change', [AuthController::class, 'changePasswordPage'])->name('passwordChange');
        Route::post('change', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::get('reset', [AuthController::class, 'resetPasswordPage'])->name('resetPasswordPage');
        Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

    });

    //profile
    Route::prefix('profile')->group(function(){
        Route::get('detail', [ProfileController::class, 'profileDetails'])->name('profileDetails');
        Route::post('update', [ProfileController::class, 'update'])->name('adminProfileUpdate');
        Route::get('account/{id}', [ProfileController::class, 'accountProfile'])->name('accountProfile');


        Route::get('create/adminAccount', [ProfileController::class, 'createAdminAccount'])->name('createAdminAccount');
        Route::post('create/adminAccount', [ProfileController::class, 'create'])->name('createAdmin');
    });

    //role
    Route::resource('role', RoleChangeController::class)->only(['destroy','index']);
    Route::get('role/userList', [RoleChangeController::class, 'userList'])->name('role.userList');
    Route::put('role/{user}/changeUserRole', [RoleChangeController::class, 'changeUserRole'])->name('role.changeUserRole');
    Route::put('role/{user}/changeAdminRole', [RoleChangeController::class, 'changeAdminRole'])->name('role.changeAdminRole');

    Route::group(['prefix' => 'saleinfo'], function(){
        Route::get('list', [SaleInfoController::class, 'saleInfoList'])->name('saleInfoList');
        Route::get('salesReportPage', [SaleInfoController::class, 'salesReportPage'])->name('salesReportPage');
        Route::get('salesReport', [SaleInfoController::class, 'salesReport'])->name('salesReport');
        Route::get('productReportPage', [SaleInfoController::class, 'productReportPage'])->name('productReportPage');
        Route::get('productReport', [SaleInfoController::class, 'productReport'])->name('productReport');
        Route::get('profitlossreportpage', [SaleInfoController::class, 'profitlossreportpage'])->name('profitlossreportpage');
        Route::get('profitlossReport', [SaleInfoController::class, 'profitlossReport'])->name('profitlossReport');
    });

    // راوتات مخصصة للدوال الحالية
    Route::get('saleinfo/list', [SaleInfoController::class, 'saleInfoList'])->name('saleInfoList');
    Route::get('saleinfo/salesReportPage', [SaleInfoController::class, 'salesReportPage'])->name('salesReportPage');
    Route::get('saleinfo/salesReport', [SaleInfoController::class, 'salesReport'])->name('salesReport');
    Route::get('saleinfo/productReportPage', [SaleInfoController::class, 'productReportPage'])->name('productReportPage');
    Route::get('saleinfo/productReport', [SaleInfoController::class, 'productReport'])->name('productReport');
    Route::get('saleinfo/profitlossreportpage', [SaleInfoController::class, 'profitlossreportpage'])->name('profitlossreportpage');
    Route::get('saleinfo/profitlossReport', [SaleInfoController::class, 'profitlossReport'])->name('profitlossReport');

    // Reports
    Route::prefix('reports')->group(function(){
        Route::get('salesReportPage', [SaleInfoController::class, 'salesReportPage'])->name('salesReportPage');
        Route::get('sales',[SaleInfoController::class, 'salesReport'])->name('salesReport');
        Route::get('productReportPage',[SaleInfoController::class, 'productReportPage'])->name('productReportPage');
        Route::get('productReport',[SaleInfoController::class, 'productReport'])->name('productReport');
        Route::get('profitlossreportpage',[SaleInfoController::class, 'profitlossreportpage'])->name('profitlossreportpage');
        Route::get('profitlossReport',[SaleInfoController::class, 'profitlossReport'])->name('profitlossReport');

    });
    Route::post('order/reject', [OrderBoardController::class, 'rejectOrder'])->name('order.reject');
    Route::post('order/removereject', [OrderBoardController::class, 'removeRejectReason'])->name('order.removeReject');

    Route::resource('order', OrderBoardController::class)->except(['create', 'store', 'edit', 'update']);


});
