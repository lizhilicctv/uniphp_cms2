<?php
use UNI\tools\Db;
class showController extends uni{
	public function __init(){
		parent::__init();
	}
	public function index(){
		$this->nav=Db::name('cate')->where('id < ?', 34)->order('id asc')->getall('id,catename');
		$this->navtwo=Db::name('cate')->where('fid = ?', 34)->order('id asc')->getall('id,catename');
		$nav_id=Db::name('article')->where('id = ?', $this->gets[0])->value('cateid');
		$this->dao=Db::name('cate')->where('id = ?',$nav_id)->get('id,catename');
		
		$this->data=Db::name('article')->where('id = ?', $this->gets[0])->get();
		$this->si=Db::name('article')->where("cateid = ? and pic <> ''", $nav_id)->limit(4)->getall('id,title,pic');
		$this->all=Db::name('article')->limit(20)->getall('id,title');
		
		$this->shi=Db::name('article')->limit(10,20)->getall('id,title');
		$this->er=Db::name('article')->where("pic <> ''",'')->limit(2)->getall('id,title,pic');
		
		$this->shang=$this->cha('shang',Db::name('article')->count());
		$this->xia=$this->cha('xia',Db::name('article')->count());
		$this->display();
	}	
	public function cha($type,$max){
		if($type == 'shang'){
			static $id=1;
			$zhi=Db::name('article')->where('id = ?', $this->gets[0]-$id)->get('id,title');
			if($zhi){
				return $zhi;
			}elseif($this->gets[0]-$id <=0){
				return [];
			}
			$id++;
			$this->cha('shang',$max);
		}
		if($type == 'xia'){
			static $id=1;
			$zhi=Db::name('article')->where('id = ?', $this->gets[0]+$id)->get('id,title');
			if($zhi){
				return $zhi;
			}elseif($this->gets[0]+$id >=$max){
				return [];
			}
			$id++;
			$this->cha('xia',$max);
		}
	}
}