<?php
use UNI\tools\Db;
class indexController extends uni{
	public function __init(){
		parent::__init();
	}
	public function index(){
		$this->nav=Db::name('cate')->where('id < ?', 34)->order('id asc')->getall('id,catename');
		$this->navtwo=Db::name('cate')->where('fid = ?', 34)->order('id asc')->getall('id,catename');
		$this->one=Db::name('article')->limit(1)->get('id,title');
		$this->three=Db::name('article')->limit(3,1)->getall('id,title');
		$this->display();
	}	
	
}