<?php
use UNI\tools\Db;
class indexController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	
 public function index()
    {
       $this->display();
    }
	//核心页面
	public function main()
    {
		//php获取今日开始时间戳和结束时间戳
		$today_start=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$today_end=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		//php获取昨日起始时间戳和结束时间戳
		$yesterday_start=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
		$yesterday_end=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
		//php获取上周起始时间戳和结束时间戳
		//$lastweek_start=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
		//$lastweek_end=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
		//php获取本周周起始时间戳和结束时间戳
		$thisweek_start=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
		$thisweek_end=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
		//php获取本月起始时间戳和结束时间戳
		$thismonth_start=mktime(0,0,0,date('m'),1,date('Y'));
		$thismonth_end=mktime(23,59,59,date('m'),date('t'),date('Y'));
		//文章统计
		$this->w=[
			'zong'=>Db::name('article')->count(),
			'jin'=>Db::name('article')->where('up_time <= ? and up_time > ?',[$today_end,$today_start])->count(),
			'zuo'=>Db::name('article')->where('up_time <= ? and up_time > ?',[$yesterday_end,$yesterday_start])->count(),
			'zhou'=>Db::name('article')->where('up_time <= ? and up_time > ?',[$thisweek_end,$thisweek_start])->count(),
			'yue'=>Db::name('article')->where('up_time <= ? and up_time > ?',[$thismonth_end,$thismonth_start])->count(),
		];
		
		//留言统计
		$this->liu=[
			'zong'=>Db::name('message')->count(),
			'jin'=>Db::name('message')->where('up_time <= ? and up_time > ?',[$today_end,$today_start])->count(),
			'zuo'=>Db::name('message')->where('up_time <= ? and up_time > ?',[$yesterday_end,$yesterday_start])->count(),
			'zhou'=>Db::name('message')->where('up_time <= ? and up_time > ?',[$thisweek_end,$thisweek_start])->count(),
			'yue'=>Db::name('message')->where('up_time <= ? and up_time > ?',[$thismonth_end,$thismonth_start])->count(),
		];
		
		//用户统计
		$this->yong=[
			'zong' =>Db::name('member')->count(),
			'jin' =>Db::name('member')->where('up_time <= ? and up_time > ?',[$today_end,$today_start])->count(),
			'zuo' =>Db::name('member')->where('up_time <= ? and up_time > ?',[$yesterday_end,$yesterday_start])->count(),
			'zhou' =>Db::name('member')->where('up_time <= ? and up_time > ?',[$thisweek_end,$thisweek_start])->count(),
			'yue' =>Db::name('member')->where('up_time <= ? and up_time > ?',[$thismonth_end,$thismonth_start])->count(),
		];
	
		//评论统计
		$this->ping=[
			'zong' =>Db::name('comment')->count(),
			'jin' =>Db::name('comment')->where('up_time <= ? and up_time > ?',[$today_end,$today_start])->count(),
			'zuo' =>Db::name('comment')->where('up_time <= ? and up_time > ?',[$yesterday_end,$yesterday_start])->count(),
			'zhou' =>Db::name('comment')->where('up_time <= ? and up_time > ?',[$thisweek_end,$thisweek_start])->count(),
			'yue' =>Db::name('comment')->where('up_time <= ? and up_time > ?',[$thismonth_end,$thismonth_start])->count(),
		];
		

		$this->log=Db::name('log')->order('id desc')->get();
		$this->count=Db::name('admin')->count();
		
      $this->display();
	   
    }
	
}