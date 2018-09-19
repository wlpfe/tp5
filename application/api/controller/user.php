<?php
/**
 * Created by PhpStorm.
 * User: maxianwei
 * Date: 18/9/13
 * Time: 下午5:40
 */
	namespace app\api\controller;
	use think\Controller;
	use think\Request;
	
	class User extends Common {
		public function index(){
			return 'user->index';
		}
		public function login(){
			$request = Request::instance();
			//dump($request->param());
			//echo 'user->login';
			$data = $this->params;
			echo $this->msg(200,'',$data);
		}
	}