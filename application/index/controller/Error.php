<?php
	#空控制器
	namespace app\index\controller;
	use \think\Controller;
	class Error extends Controller{
		public function index(){
			$this->redirect('index/index');
		}
		public function _empty(){
			$this->redirect('index/index');
		}
	}
	
?>