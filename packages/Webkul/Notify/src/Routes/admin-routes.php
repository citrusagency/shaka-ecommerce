<?php

use Illuminate\Support\Facades\Route;
use Webkul\Notify\Http\Controllers\Admin\NotifyController;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => config('app.admin_url')], function () {
    Route::get('/notify', [NotifyController::class, 'index'])->name('admin.notify.index');

    Route::post('/notify/update-stock-status', [NotifyController::class, 'updateStockStatus'])->name('admin.notify.updateStockStatus');
});