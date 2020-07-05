<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function (){

    Route::get('/admin', 'AdminController@index')->name('admin.deshboard');
    Route::get('/admin/post/create', 'PostController@create')->name('post.create');
    Route::post('/admin/post/', 'PostController@store')->name('post.store');
    Route::get('/admin/post/all', 'PostController@index')->name('post.index');
    Route::get('/admin/post/{post}', 'PostController@show')->name('post.show');
    Route::get('/admin/post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('/admin/post/{post}/update', 'PostController@update')->name('post.update');
    Route::delete('/admin/post/{post}/delete', 'PostController@destroy')->name('post.delete');


//    Route::get('admin/user/{user}/profile', 'UserController@show')->name('user.profile.show');
    Route::put('admin/user/{user}/profile/update', 'UserController@update')->name('user.profile.update');



    Route::delete('admin/users/{user}/delete', 'UserController@destroy')->name('users.delete');

    Route::put('admin/users/{user}/attach','UserController@attach')->name('user.role.attach');
    Route::put('admin/users/{user}/detach', 'UserController@detach')->name('user.role.detach');



});

Route::middleware(['auth', 'can:view,user'])->group(function(){
    Route::get('admin/user/{user}/profile', 'UserController@edit')->name('user.profile.edit');
});

Route::middleware('role:administrator')->group(function (){

    Route::get('admin/users/view-all', 'UserController@index')->name('users.index');

    Route::get('admin/roles/', 'RoleController@index')->name('user.role');
    Route::post('admin/roles/store', 'RoleController@store')->name('user.store');
    Route::delete('admin/roles/{role}/destroy', 'RoleController@destroy')->name('user.role.destroy');

    Route::get('admin/permissions/', 'PermissionController@index')->name('user.permission');

    Route::get('admin/role/{role}/edit', 'RoleController@edit')->name('user.role.edit');
    Route::put('admin/role/{role}/update', 'RoleController@update')->name('user.role.update');

    Route::post('admin/permission/', 'PermissionController@store')->name('user.permission.store');
    Route::delete('admin/permission/{permission}/destory', 'PermissionController@destroy')->name('user.permission.destory');
    Route::put('admin/role/{role}/attach', 'RoleController@attach')->name('role.permission.attach');
    Route::put('admin/role/{role}/detach', 'RoleController@detach')->name('role.permission.detach');


});
