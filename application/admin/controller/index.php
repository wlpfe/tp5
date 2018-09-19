<?php
	namespace app\admin\controller;
	use think\Controller;
	use think\Request;
	
	class Index extends Controller{
		public function index(){
			return 'backend';
		}
		public function testadmin(){
			$request = Request::instance();
			dump($request->param());
			return 'testadmin function';
		}
	}
?>