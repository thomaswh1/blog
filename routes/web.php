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

//前台路由

//登录
Route::get('login','Home\LoginController@login');
Route::post('hdologin','Home\LoginController@dologin');
//退出登录
Route::get('hlogout','Home\LoginController@logout');
//注册
Route::resource('homeuser','Home\HomeuserController');

Route::get('index','Home\IndexController@index');
Route::get('lists/{id}','Home\IndexController@lists');
Route::get('detail/{id}','Home\IndexController@detail');

//收藏，点赞路由
Route::post('collect','Home\IndexController@collect');
Route::post('love','Home\IndexController@love');

//搜寻路由
Route::get('search','Home\IndexController@search');
//留言路由
Route::get('liuyan','Home\IndexController@liuyan');



//Route::get('/code/captcha/{tmp}','Admin\LoginController@captcha');

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function() {
    //后台登录路由
    Route::get('login','LoginController@login');
    //验证码路由
        Route::get('code','LoginController@code');

    //处理后台登录的路由
        Route::post('dologin','LoginController@doLogin');

    //加密算法
        Route::get('jiami','LoginController@jiami');

});

Route::get('noaccess','Admin\LoginController@noaccess');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['isLogin']],function(){
//    ,'hasRole'
    //后台首页
    Route::get('index','LoginController@index');
    //后台欢迎页
    Route::get('welcome','LoginController@welcome');
    //后台退出登录
    Route::get('logout','LoginController@logout');

// 后台用户模块相关路由
    Route::get('user/editpass/{id}','UserController@editpass');
    Route::post('user/doedit','UserController@doEdit');

    Route::get('user/del','UserController@delAll');
    Route::resource('user','UserController');
    //用户授权
    Route::get('user/auth/{id}','UserController@auth');
    Route::post('user/doauth','UserController@doAuth');


//    角色模块
    // 角色授权路由
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');

    Route::get('role/del','RoleController@delAll');
    Route::resource('role','RoleController');


//    权限模块授权
    Route::get('permission/del','PermissionController@delAll');
    Route::resource('permission','PermissionController');

//   分类路由
    //修改排序
    Route::post('cate/changeorder','CateController@changeOrder');
    Route::resource('cate','CateController');

//   文章模块
    Route::post('article/upload','ArticleController@upload');
    //文章推荐
    Route::get('article/tuijian/{id}','ArticleController@tuijian');

    Route::get('article/del','ArticleController@delAll');
    Route::resource('article','ArticleController');


//    网站配置模块
    Route::post('config/changecontent','ConfigController@changeContent');
    Route::get('config/putcontent','ConfigController@putContent');
    Route::resource('config','ConfigController');

//    友情链接模块
    Route::get('link/del','LinkController@delAll');
    Route::resource('link','LinkController');

//前台用户模块
    Route::resource('homeuser','HomeuserController');




});
