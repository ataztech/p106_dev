<?php

Route::group(['module' => 'Payment', 'middleware' => ['web'], 'namespace' => 'App\Modules\Payment\Controllers'], function() {

    Route::get('/admin/payment/list','PaymentController@paymentList');
    Route::get('/admin/payment/data','PaymentController@paymentData');
    Route::get('/admin/total/payment','PaymentController@totalPayment');



});
