<?php

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

Route::get('/', function(){
   // return view('welcome');
    return view('welcome_bk');
    //return view('maintainance');
});

Route::get('/test/new', function(){
    return view('welcome');
});


Route::get('admin/logout', function(){
    Auth::logout();
    return redirect('/admin/login')->with('success','Logout Successful');
});

Route::get('telecaller/logout', function(){
    Auth::logout();
    return redirect('/telecaller/login')->with('success','Logout Successful');
});

/*Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
});*/

Route::get('logout','HomeController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/price/details', 'HomeController@priceDetails');
Route::get('/get/price', 'HomeController@getPrice');
Route::post('/process-payment','RazorpayController@processDetail');
Route::post('/verify-payment','RazorpayController@verifyPayment');
Route::get('/chk-mobile-duplicate','HomeController@checkMobileNumber');

Route::post('/register/student','HomeController@registerStudent');

Route::get('/send/message','HomeController@sendMessage');
Route::post('/check-forgot-password-number','HomeController@verifyForgotPasswordNUmber');

//Route::get('/login', function(){
//    return redirect('/');
//    
//});
Route::get('/dashboard', 'HomeController@dashboard')->name('home')->middleware('auth','userstate');
Route::get('/examiner/dashboard', 'HomeController@examinerDashboard')->name('home')->middleware('auth');


Route::get('/admin/login', 'AdminController@login');
Route::get('/admin/email', 'AdminController@email');
Route::post('/send-enquiry', 'ContactUsController@createContactUs');


Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

//api routes
Route::get('update/wrong-question', 'ApiController@setQuestionFlag');
Route::get('api/test1', 'ApiController@test1');
Route::get('check/wrong-question', 'ApiController@chkQuestion');
Route::post('api/user/test', 'ApiController@test')->middleware('cors');
Route::post('api/user/login', 'ApiController@login')->middleware('cors');
Route::post('api/user/dashboard', 'ApiController@getDashboardData')->middleware('cors');
Route::post('api/user/subject/chapters', 'ApiController@getSubjectChapters')->middleware('cors');
Route::post('api/user/subject/chapters/topic', 'ApiController@getSubjectChaptersTopic')->middleware('cors');
Route::post('api/user/subject/chapters/topic/practice', 'ApiController@chapterTopicAssess')->middleware('cors');
Route::post('api/user/practice/check-answer', 'ApiController@getAnswer')->middleware('cors');
Route::post('api/user/submit/report/practice', 'ApiController@submitReport')->middleware('cors');
Route::post('api/user/practice/get-report', 'ApiController@getReport')->middleware('cors');
Route::post('api/user/practice/reset', 'ApiController@resetTest')->middleware('cors');
Route::post('api/user/concept', 'ApiController@getConcepet')->middleware('cors');
Route::post('api/user/top-ten-questions', 'ApiController@getChapterDifficultyQuestions')->middleware('cors');

// test series routes
Route::post('api/user/tests/all', 'ApiController@allTests')->middleware('cors');
Route::post('api/user/tests/new', 'ApiController@newExamTests')->middleware('cors');
Route::post('api/user/tests/missed', 'ApiController@missedExamTests')->middleware('cors');
Route::post('api/user/tests/attempted', 'ApiController@attemptedExamTests')->middleware('cors');
Route::post('api/user/tests/attempt', 'ApiController@attempTest')->middleware('cors');
Route::post('api/user/view-syllabus', 'ApiController@getTestSyllabus')->middleware('cors');
// end test series routes
Route::post('api/exam/test/submit-answer', 'ApiController@submitTestAnswer')->middleware('cors');
Route::post('api/exam/test/get-report', 'ApiController@getTestReport')->middleware('cors');

//end api routes

// sales-api routes start here

Route::post('/sales/login','SalesApiController@counsellorLogin')->middleware('cors');
Route::post('/sales/demo-list','SalesApiController@counsellorDemoList')->middleware('cors');
Route::post('/sales/demo-finish','SalesApiController@counsellorDemoFinish')->middleware('cors');
Route::post('/sales/demo-add','SalesApiController@counsellorDemoCreate')->middleware('cors');
Route::post('/sales/demo-edit','SalesApiController@counsellorEditDemo')->middleware('cors');
Route::post('/sales/demo-save','SalesApiController@counsellorUpdateDemo')->middleware('cors');
Route::post('/sales/student-add','SalesApiController@counsellorStudentAdd')->middleware('cors');
Route::post('/sales/student-list','SalesApiController@counsellorStudentList')->middleware('cors');

Route::post('/sales/demo-send-otp','SalesApiController@demoSendOTP')->middleware('cors');
Route::post('/sales/demo-submit-otp','SalesApiController@demoSubmitOTP')->middleware('cors');


// sales-api routes end here

Route::get('/{slug}', 'HomeController@cms');

