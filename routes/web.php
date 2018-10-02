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

Route::get('/','AuthController@login')->name('login');
Route::post('post-login','AuthController@postlogin')->name('postlogin');
Route::get('register','AuthController@registration')->name('register');
Route::post('register','AuthController@register')->name('register');
Route::get('logout','AuthController@logout')->name('logout');
Route::get('pass-change','AuthController@passchange')->name('passchange');

Route::post('forget-password-process','AuthController@forgetpasswordprocess')->name('forgetPasswordProcess');
Route::get('forget-password-Reset','AuthController@forgetpasswordreset')->name('forgetPasswordReset');

Route::get('forget-password-change/{reset_code}', 'AuthController@forgetPasswordChange')->name('forgetPasswordChange');

Route::post('forget-password-reset-process/{reset_code}', 'AuthController@forgetPasswordResetProcess')->name('forgetPasswordResetProcess');


Route::group(['namespace'=>'User','middleware'=>['auth','user']],function(){

    Route::get('user-Dashboard','UserController@userDashboard')->name('userDashboard');

});

Route::group(['namespace'=>'Admin','middleware'=>['auth','admin']],function(){

    Route::get('admin','AdminController@adminDashboard')->name('adminDashboard');
    Route::get('user-list','AdminController@userList')->name('userlist');
    Route::get('add-User','AdminController@addUser')->name('addUser');
    Route::post('user-save','AdminController@saveUser')->name('userSave');
    Route::get('user-edit/{edit_id}','AdminController@userEdit')->name('userEdit')->where('id','[0-9]+');
    Route::get('user-delete-{id}','AdminController@userDelete')->name('userDelete')->where('id', '[0-9]+');

    Route::get('project-list','ProjectController@projectList')->name('project');
    Route::get('project-add','ProjectController@addProject')->name('projectAdd');

    Route::post('save-project','ProjectController@saveProject')->name('projectSave');

    Route::get('project-edit/{id}','ProjectController@projectEdit')->name('projectEdit')->where('id', '[0-9]+');
    Route::post('project-save','ProjectController@saveProject')->name('projectSave');
    Route::get('project-delete-{id}','ProjectController@projectDelete')->name('projectDelete')->where('id', '[0-9]+');

    Route::post('set-zira-required','ProjectController@setZiraRequired')->name('setZiraRequired');

});

Route::group(['namespace'=>'Common','middleware'=>'auth'],function(){
    Route::get('user-profile/{user_id}','UserController@userProfile')->name('user')->where('id','[0-9]+');
    Route::get('edit-profile/{edit_id}','UserController@editProfile')->name('profileUpdate')->where('id','[0-9]+');
    Route::get('pass-change/{id}','UserController@passChange')->name('passChange')->where('id','[0-9]+');
    Route::post('profile-update-process','UserController@updateProfileProcess')->name('profileUpdateProcess')->where('id','[0-9]+');
    Route::post('save-user-pass','UserController@savePass')->name('passChangeSave');

    Route::get('daily-update-list','DailyUpdateController@dailyUpdateList')->name('dailyUpdateList');
    Route::get('daily-update/{id}','DailyUpdateController@singleDailyUpdate')->name('singleDailyUpdate');

});

Route::group(['namespace'=>'User','middleware'=>['auth','user']],function(){

    Route::get('user-Dashbosrd','UserController@userDashboard')->name('userDashboard');
    Route::get('daily-update','UserController@dailyUpdate')->name('dailyUpdate');
    Route::post('daily-update-process','UserController@dailyUpdateProcess')->name('dailyUpdateProcess');

});