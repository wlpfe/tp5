<?php
/**
 * Created by PhpStorm.
 * User: maxianwei
 * Date: 18/9/8
 * Time: 上午11:07
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
class Pages extends Controller{
	public function index(){
		//$lists = Db::name('chatlog')->paginate(2);
		#获取后直接处理,不用在foreach一下了
		/*$lists = Db::name('chatlog')->paginate(2)->each(function ($item,$key){
			$item['nickname'] = 'mxw';
			return $item;
		});*/
		#简单分页
		$lists = Db::name('chatlog')->paginate(2,true,['type'=>'bootstrap','var_page'=>'page']);
		dump(Db::getLastSql());
//		dump($lists);
		$page = $lists->render();
		$this->assign('lists',$lists);
		$this->assign('page',$page);
		return $this->fetch();
	}
	
	public function upload(){
		$file = request()->file('image');
		if($file){
			//$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
			$info = $file->move(ROOT_PATH.'public'.DS.'uploads','');//保留原文件名称,覆盖同名文件
			$info = $file->move(ROOT_PATH.'public'.DS.'uploads',true,false);//移动到服务器的上传目录 并且设置不覆盖
			
			dump($info);
			if($info){
				echo $info->getExtension();
				echo $info->getSaveName();
				echo $info->getFilename();
			}else{
				echo $file->getError();
			}
		}else{
			$this->error('no file');
		}
	}
	public function uploads(){
		$files = request()->file('image');
		foreach ($files as $file){
			if($file){
				//文件名使用md5
				$info = $file->validate(['ext'=>'png,jpg','size'=>15678000])->rule('md5')->move(ROOT_PATH.'public'.DS.'uploads');
				dump($info);
				if($info){
					echo $info->getExtension();
					echo $info->getSaveName();
					echo $info->getFilename();
					echo '<br>';
					echo $info->md5();
					echo '<br>';
					echo $info->sha1();
					echo '<hr>';
				}else{
					echo $file->getError();
				}
			}else{
				$this->error('no file');
			}
		}
	}
}