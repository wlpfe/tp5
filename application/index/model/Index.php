<?php
	namespace app\index\model;
	use think\Model;
	class Index extends Model{
		protected $connection = [
			// 数据库类型
			'type'            => 'mysql',
			// 服务器地址
			'hostname'        => '127.0.0.1',
			// 数据库名
			'database'        => 'ly',
			// 用户名
			'username'        => 'root',
			// 密码
			'password'        => 'ma',
			// 端口
			'hostport'        => '3306',
			'prefix'          => 'ad_a_',
		];
	}
?>