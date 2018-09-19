<?php
/**
 * Created by PhpStorm.
 * User: maxianwei
 * Date: 18/9/8
 * Time: 上午9:17
 */
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Cache;
use think\Lang;
use think\Session;
use think\Coookie;
class Caches extends Controller {
	public function index(){
		echo CACHE_PATH;
		echo "<hr>";
		$lists = Db::name('chatlog')->where("fromid",1)->select();
		dump($lists);
		//$cache = Cache::set('lists',$lists);
		//设置缓存时间
		$cache = Cache::set('lists',$lists,200);
		dump($cache);
	}
	public function getCache(){
		$cache = Cache::get('lists');
		dump($cache);
		$cache2 = cache('lists');
		dump($cache2);
	}
	public function delCache(){
		//方法1
		//dump(Cache::rm('lists'));
		//方法2
		//Cache::set('lists',NULL);
		
		//清空缓存
		dump(Cache::clear());
	}
	public function useCache(){
		if(!cache('lists')){
			echo 'mysql';
			echo '<br>';
			$lists = Db::name('chatlog')->where("fromid",1)->select();
			$cache = Cache::set('lists',$lists,30);
		}else{
			echo 'cache';
			echo '<br>';
			dump(cache('lists'));
		}
	}
	public function setSession(){
		$lists = Db::name('chatlog')->where("fromid",1)->select();
		dump($lists);
		dump(Session::set('lists',$lists));//返回NULL 无返回值
		Session::set('ma.name','mxw');
		#指定当前作用域
		#Session::prefix('think');
	}
	public function getSession(){
		/*$lists = Session::get('lists');
		dump($lists);
		if(Session::has('lists')){
			dump('lists 存在');
		}*/
		dump(Session::get('ma'));
		#取出并删除
		$lists = Session::pull('lists');
		dump($lists);
		
	}
	public function delSession(){
		#Session::delete('lists');
		Session::clear();
	}
	public function flashSession(){
		Session::flush('ma',1);
	}
	
	//cookie
	public function setCookie(){
		dump(Cookie::set('name','mxw',3600));
		$lists = Db::name('chatlog')->where("fromid",1)->select();
		dump(Cookie::set('lists',$lists));
		Cookie::forever('name1','maxianwei');//永久保存
	}
	public function getCookie(){
		dump(Cookie::get('name'));
		dump(Cookie::get('lists'));
	}
	public function delCookie(){
		Cookie::delete('name');
//		Cookie::clear();
		Cookie::clear('Mac_');//删除指定前缀
		cookie(null,'Mac_');//使用助手函数
	}
	public function hasCookie(){
		dump(Lang::get('success'));//语言包
		dump(Cookie::has('name'));
		dump(cookie('?name'));
	}
}