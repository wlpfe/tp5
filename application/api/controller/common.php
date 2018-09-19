<?php
/**
 * Created by PhpStorm.
 * User: maxianwei
 * Date: 18/9/13
 * Time: 下午6:13
 */
	namespace app\api\controller;
	use think\Controller;
	use think\Request;
	use think\Validate;
	class Common extends Controller {
		protected $request;
		protected $validate;//验证数据
		protected $params;//过滤后的参数
		var $limitTime = 60;
		//$rules['User']['login']
		protected $rules = [
			'User'	=>	[
				'login'	=>	[
					'user_name'	=>	['require','chsDash','max'=>20],
					'user_pwd'	=>	['require','length'=>32],
				],
			],
		];
		protected function _initialize(){
			$this->request = Request::instance();
			//$this->check_time($this->request->only(['time']));
			//$this->check_token($this->request->param());
			$this->check_params($this->request->except(['time','token']));
		}
		
		/**
		 * @param $arr
		 */
		public function check_time($arr){
			if(!isset($arr['time']) || intval($arr['time']) <= 1){
				$this->msg(400,'时间戳不存在');
			}
			if(time() - intval($arr['time']) > $this->limitTime){
				$this->msg(400,'请求超时');
			}
		}
		
		/**
		 * @param $arr
		 */
		public function check_token($arr){
			//dump($arr);
			if(!isset($arr['token']) || empty($arr['token'])){
				$this->msg(400,'token不存在');
			}
			$app_token = $arr['token'];
			unset($arr['token']);
			$server_token = '';
			foreach ($arr as $k=>$v){
				$server_token .= md5($v);
			}
			$server_token = md5('api_'.$server_token.'_api');
			#dump($server_token);
			if($server_token != $app_token){
				$this->msg(400,'token 校验失败');
			}
		}
		public function check_params($arr){
			$rule = $this->rules[$this->request->controller()][$this->request->action()];
			$this->validate = new Validate($rule);
			if(!$this->validate->check($arr)){
				$this->msg(400,$this->validate->getError());
			}else{
				$this->params = $arr;
			}
		}
		/**
		 * @param $code
		 * @param string $msg
		 * @param array $data
		 */
		public function msg($code,$msg='',$data=[]){
			$return['code'] = $code;
			$return['msg'] = $msg;
			$return['data'] = $data;
			echo json_encode($return);
			die;
		}
	}