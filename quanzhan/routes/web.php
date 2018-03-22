<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('demo', 'DemoController@demo');
//部署前台的路由
Route::group(['namespace' => 'Home'], function () {
    //展示直播课程的页面；
    Route::get('person/livecourse', 'PersonController@livecourse');
    //进入直播间的路由
    Route::get('person/video/play/{stream}', 'VideoController@play');
    //前台会员登录
    Route::get('login', 'MemberController@login');
    //前台会员注册
    Route::get('register', 'MemberController@register');
    //处理会员登录的
    Route::post('login_check', 'MemberController@login_check');
    Route::get('home/live/detail', 'LiveController@detail');
    //网站首页
    Route::get('/', 'IndexController@index');
    //查看课时详情
    Route::get('course/detail/{course}', 'CourseController@detail');

    //添加到购物车；
    Route::get('cart/add/{course}', 'CartController@add');
    //购物车列表
    Route::get('cart/index', 'CartController@index');
    //添加订单的
    Route::get('order/add', 'OrderController@add');
    //支付完成后的页面
    Route::get('order/done', 'OrderController@done');

    //前台展示卷子
    Route::get('person/paper', 'PersonController@paper');
    //展示考试试题
    Route::get('person/exam/{paper}', 'PersonController@exam');
    //接收提交答案的路由
    Route::post('person/answer/{paper}', 'PersonController@answer');

    //展示答题结果的一个页面；
    Route::get('person/result', 'PersonController@result');
});
//部署后台的路由
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'login'], function () {
        //后台首页
        Route::get('index', 'IndexController@index');
        Route::get('welcome', 'IndexController@welcome');
        //课时列表
        Route::match(['get', 'post'], 'lesson/index', 'LessonController@index');
        Route::match(['get', 'post'], 'course/index', 'CourseController@index');
        Route::match(['get', 'post'], 'profession/index', 'ProfessionController@index');
        //修改状态的路由
        Route::post('lesson/status/{lesson}', 'LessonController@status');
        //添加课时的路由
        Route::match(['get', 'post'], 'lesson/add', 'LessonController@add');
        Route::match(['get', 'post'], 'course/add', 'CourseController@add');
        Route::match(['get', 'post'], 'profession/add', 'ProfessionController@add');
        //定义上传图片的路由
        Route::post('lesson/upimage', 'LessonController@upimage');
        //定义上传视频的路由
        Route::post('lesson/upvideo', 'LessonController@upvideo');
        //定义一个视频播放的路由
        Route::get('lesson/play/{lesson}', 'LessonController@play');

        //定义一个修改课时的路由
        Route::match(['get', 'post'], 'lesson/update/{lesson}', 'LessonController@update');

        //定义删除课时的路由
        Route::post('lesson/del/{lesson}', 'LessonController@del');
        //定义批量删除的路由
        Route::post('lesson/datadel', 'LessonController@datadel');

        //直播流列表
        Route::get('stream/index', 'StreamController@index');
        //直播流添加
        Route::match(['get', 'post'], 'stream/add', 'StreamController@add');

        //直播课程列表
        Route::get('livecourse/index', 'LivecourseController@index');
        //直播课程添加
        Route::match(['get', 'post'], 'livecourse/add', 'LivecourseController@add');
        //定义生成推流地址的路由
        Route::get('livecourse/getPush/{livecourse}/{stream}', 'LivecourseController@getPush');
        //退出登录的
        Route::get('logout', 'ManagerController@logout');
        //角色列表
        Route::get('role/index', 'RoleController@index');
        //修改角色
        Route::match(['get', 'post'], 'role/update/{role}', 'RoleController@update');
        //权限列表
        Route::get('privilege/index', 'PrivilegeController@index');
        //添加权限的路由
        Route::match(['get', 'post'], 'privilege/add', 'PrivilegeController@add');

        //试卷列表
        Route::get('paper/index', 'PaperController@index');
        //试题列表
        Route::get('question/index/{paper}', 'QuestionController@index');
        //添加试题
        Route::match(['post', 'get'], 'question/add/{paper}', 'QuestionController@add');

        //管理员管理
        Route::get('manager/index', 'ManagerController@index');
        Route::match(['post', 'get'], 'manager/add', 'ManagerController@add');

//        Route::get('manager/index', 'ManagerController/@index');
    });

    //显示登录页面的路由
    Route::get('login', 'ManagerController@login');
    //验证登录是否成功的路由
    Route::post('login_check', 'ManagerController@login_check');

});
// get('/', function () {
//     return view('welcome');
// });
