<?php
/**
 * Created by PhpStorm.
 * User: maxianwei
 * Date: 18/9/10
 * Time: 下午6:24
 */
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Validate;

class TestApi extends Controller{
	public function index(){
		$data = [
			'name'	=>	'red_panda',
			'address'	=>'China',
		];
		$code = 200;
		$msg = 'ok';
		$requset = Request::instance();
		$method = $requset->method();
		if($requset->isGet()){
			dump('是GET');
		}
		$infos = input('post.');
		dump($infos);
		//$fields['name'] = addslashes(input('name'));
		$fields['name'] = input('name');
		$fields['content'] = htmlspecialchars(input('content'));
		//在coonfig 里面 default_return_type 设置成 json 否则会报错
		//return ['data'=>$data,'code'=>$code,'message'=>$msg,'method'=>$method,'fields'=>$fields];
		if(Db::name('user')->insert(['username'=>$fields['name'],'password'=>md5('123123'),'content'=>$fields['content']])){
			dump(Db::getLastSql());
			//$this->success('OK');
		}
		#return json(['data'=>$data,'code'=>$code,'message'=>$msg]);
		#return xml(['data'=>$data,'code'=>$code,'message'=>$msg]);
	}
	
	public function add(){
		dump('123');
		$rule = [
			'name'	=>	'require|max:2|chs',
			'age'	=>	'require|between:1,20',
			'email'	=>	'require|email',
		];
		$msg = [
			'name.require'	=>	'名字必填哦',
			'name.chs'	=>	'必须中文',
			'name.max'	=>	'只能2个汉字',
		];
		//$data = input('post.');
		//$data = input('get.');
		$data = Request::instance()->param();
		$request = Request::instance();
		dump($request->only('name'));
		//$data = $request->post('');
		dump($data);
		$validate = new Validate($rule,$msg);
		$result = $validate->check($data);
		if(!$result){
			dump($validate->getError());
		}
	}
	
}
