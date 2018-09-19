<?php
	#声明命名空间
	namespace app\index\controller;
	use think\Controller;
	use think\Db;
	use think\View;
	class User extends Controller{
		public function index(){
			#方式1
			//return view();
			#方式2
			/*
			$lists = [
				['name'=>'mxw','age'=>20],
				['name'=>'yp','age'=>18]
			];
			//$this->assign('lists',$lists);
			$view = new \think\view;
			return $view->fetch();*/
			#方式3
			#$view = new View();
			#return $view->fetch();
			#方式4
			return $this->fetch();//think\Controller 下方法
			
			
		}
		public function test(){
			return 'user test';
		}
		public function test2(){
			return 'user test2';
		}
	}
?>