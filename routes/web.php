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
Route::get('/sample', function () {
    $UserModel = App\UserModel::with(['user_type', 'user_detail'])->get();

    foreach($UserModel as $u)
    {
        echo decrypt($u->password) .  '<br >';
    }

    return json_encode($UserModel);

});
Route::get('/', function () {

    return view('welcome');
});

//Auth::routes();
Route::get('/login', [ 'uses'=>'Auth\LoginController@getLogin', 'as'=>'userlogin' ]);
Route::post('/login', [ 'uses'=>'Auth\LoginController@login', 'as'=>'login' ]);
Route::post('/logout', [ 'uses'=>'Auth\LoginController@getLogout', 'as'=>'userlogout' ]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::get('/', ['uses' => 'UserController@index', 'as' => 'user'] );
    Route::POST('/list', ['uses' => 'UserController@list_users', 'as' => 'dir_coordi'] );
    Route::post('/create', ['uses' => 'UserController@create_user', 'as' => 'dir_coordi_create'] );  
    Route::post('/edit_modal', ['uses' => 'UserController@edit_user_modal', 'as' => 'dir_coordi_edit_modal'] );  
    Route::post('/delete', ['uses' => 'UserController@delete_user', 'as' => 'dir_coordi_delete'] );  
    Route::post('/edit', ['uses' => 'UserController@edit_user', 'as' => 'dir_coordi_edit'] );  
});
