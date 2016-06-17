<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login')->name('login');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');

Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\AuthController@register')->name('register');

Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('pwdreset');
Route::post('password/reset', 'Auth\PasswordController@reset')->name('pwdresets');
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::get('/autologin',['as'=>'auth.autologin','uses'=>'Auth\AuthController@autoLogin']);
Route::post('/paynotify',['as'=>'alipay.notify','uses'=>'AlipayController@payNotify']);

Route::group(['middleware'=>'auth:web'],function (){

    Route::get('password/change', 'Auth\PasswordController@showPwdChange');
    Route::post('password/change', 'Auth\PasswordController@changePwd');

    Route::get('/',['as'=>'message.index','uses'=>'MessageController@index']);
    Route::get('/messages',['as'=>'message.index','uses'=>'MessageController@index']);
    Route::get('/message/{message}',['as'=>'message.show','uses'=>'MessageController@show'])->where('message','[0-9]+');
    Route::get('/message/{message}/reply',['as'=>'message.create_reply','uses'=>'MessageController@createReply'])->where('message','[0-9]+');
    Route::put('/message/{message}/reply',['as'=>'message.send_reply','uses'=>'MessageController@sendReply'])->where('message','[0-9]+');

    Route::get('/message/manage',['as'=>'message.manage','uses'=>'MessageController@manage']);
    Route::get('/message/{message}/delete',['as'=>'message.delete','uses'=>'MessageController@showDelete'])->where('message','[0-9]+');
    Route::delete('/message/{message}/delete',['as'=>'message.delete','uses'=>'MessageController@delete'])->where('message','[0-9]+');

    Route::get('/product',['as'=>'product.show','uses'=>'AlipayController@show']);
    Route::post('/pay',['as'=>'alipay.pay','uses'=>'AlipayController@pay']);

    Route::get("/profile",['as'=>'user.profile','uses'=>'UserController@profile']);

    Route::group(['middleware'=>'permission_requried','permissions'=>'admin'],function(){
        Route::get('/users',['as'=>'user.index','uses'=>'UserController@index']);
        Route::get('/user/{user}',['as'=>'user.show','uses'=>'UserController@show'])->where('message','[0-9]+');
        Route::get('/user/{user}/edit',['as'=>'user.edit','uses'=>'UserController@showEdit'])->where('message','[0-9]+');

        Route::put('/user/{user}/edit',['as'=>'user.edit','uses'=>'UserController@update'])->where('message','[0-9]+');

        Route::delete('/user/{user}/delete',['as'=>'user.delete','uses'=>'UserController@delete'])->where('user','[0-9]+');;
    }
    );

});

Route::group(['middleware'=>'api'],function(){

    Route::post('/apimessage', 'MessageAPIController@post');
} );
