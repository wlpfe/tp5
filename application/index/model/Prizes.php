<?php
	namespace app\index\model;
	use think\Model;
	use traits\model\SoftDelete;//软删除
	class Prizes extends Model{
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
		#protected $table = 'ad_a_infos';
		//自动完成 设置器
		//protected $auto = ['dateline','status'];//一般不用
		//protected $insert = ['dateline','status'];//插入的时候调用
		protected $update = ['updateline'];//更新的时候调用
		protected $autoWriteTimestamp = true;//要求时间字段为 creat_time 和 update_time
		//当数据库没有这个字段的时候,可以自己手动设置
		protected $createTime = 'dateline';
		protected $updateTime = 'updateline';
		//protected $updateTime = false;//取消字段的自动更新
		//软删除
		use SoftDelete;
		
		
		
		protected function setDatelineAttr(){
			return time();
		}
		protected function setStatusAttr(){
			return 2;
		}
		//获取器
		//nums 为字段名
		public function getNumsAttr($val){
			if($val == 0){
				$msg = '未知';
			}elseif($val == 1){
				$msg = '男';
			}elseif($val == 2){
				$msg = '女';
			}else{
				$msg = 'other';
			}
			return $msg;
		}
		public function setPassAttr($val){
			return md5($val);
		}
	}
?>