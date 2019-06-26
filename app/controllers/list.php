<?php
use UNI\tools\Db;
class listController extends uni{
	public function __init(){
		parent::__init();
	}
	public function index(){
		$this->nav=Db::name('cate')->where('id < ?', 34)->order('id asc')->getall('id,catename');
		$this->navtwo=Db::name('cate')->where('fid = ?', 34)->order('id asc')->getall('id,catename');
		$this->dao=Db::name('cate')->where('id = ?', $this->gets[0])->get('id,catename,');
		$this->list=Db::name('article')->where('cateid = ?', $this->gets[0])->order('id asc')->paginate(20)->fields('up_time,id,title');
		$this->si=Db::name('article')->where("cateid = ? and pic <> ''", $this->gets[0])->limit(4)->getall('id,title,pic');
		$this->all=Db::name('article')->limit(20)->getall('id,title');
		$this->display('list.php');
	}	
	
}