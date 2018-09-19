<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
#静态地址路由
use \think\Route;

Route::rule('user','api/user/login');


#设置路由后,pathinfo就不能用了
#Route::rule('/','index/index/index');
#Route::domain('api','api');
#Route::rule('api','/index.php/index/testapi');
#Route::rule('api/add','/index.php/index/testapi/add');
Route::rule('admin','index/admin/index/testadmin');//不带参数
#Route::rule('course/:id','index/index/course');//1个参数
Route::rule('time/:year/:month','index/index/time');//2个参数,如果确实参数会报错
Route::rule('time/:year/[:month]','index/index/time');//2个参数,第2个参数可选
//全动态路由 一般不建议用
#Route::rule(':a/:b','index/index/dongtai');
Route::rule('diaoyong2$','index/index/diaoyong2');//加$ 完全匹配,如果多参数会报错,不能访问
#Route::rule('test1','index/index/test1?a=1&b=2');//带额外参数

#设置路由请求方式 默认支持所有方式
#Route::rule('type','index/index/type','get');
#Route::rule('type','index/index/type','post');
#Route::rule('type','index/index/type','get|post');
#Route::rule('type','index/index/type','*');//所有方式
#Route::any('type','index/index/type');//所有方式
#Route::rule('type','index/index/type','put');//put 方式
#Route::put('type','index/index/type');//put 方式

#动态批量注册路由
/*
Route::rule([
	'type'	=>	"index/index/type",
	'test1'	=>	"index/index/test1",
],'','get');
*/
/*
Route::get([
	'type'	=>	"index/index/type",
	'test1'	=>	"index/index/test1",
]);
*/
/*
return [
	'type'	=>	"index/index/type",
	'test1'	=>	"index/index/test1",
];*/
#变量规则
#Route::rule('course/:id',"index/index/course","get|post",[],['id'=>'\d+']);
#Route::rule('course/:id/[:name]',"index/index/course","get|post",[],['id'=>'\d+','name'=>'\w+']);

#路由参数
#Route::rule('course/:id/[:name]',"index/index/course","*",['method'=>'get','ext'=>'html'],['id'=>'\d+','name'=>'\w+']);//http://www.tp5.com/course/1.html

#资源路由
#Route::resource('blog','index/blog');//会自动生成7个index create save read edit update delete
#快捷路由
Route::controller('blog','index/blog');
/*
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
