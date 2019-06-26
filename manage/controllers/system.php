<?php
use UNI\tools\Db;
class systemController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	public function index()
    {
	  if(UNi_POST){
		 foreach($_POST as $k=>$v){
			 Db::name('system')->where('enname = ?',$k)->update(['value'=>$v]);
		 }
		 //echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
		$this->success('修改成功');
	  }else{
		  $this->data=Db::name('system')->getall();
	  }
	  $this->display();
    }
	public function add()
    {
    	if(UNi_POST){
			//表单验证
			$checkRules = [
					'cnname'  => [
						['must', '', '中文名称必须填写'],
					],
					'enname' =>[
						['must', '', '英文名称必须填写'],
					],
					'type' =>['must', '', '类型必须填写'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			
			$info=Db::name('system')->add($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
    	}
      $this->display();
    }
    
	public function edit()
    {
		if(UNi_POST){
			//表单验证
			$checkRules = [
					'cnname'  => [
						['must', '', '中文名称必须填写'],
					],
					'enname' =>[
						['must', '', '英文名称必须填写'],
					],
					'type' =>['must', '', '类型必须填写'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			
			
			$info=Db::name('system')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
		}
		$this->data=Db::name('system')->where('id = ?', $this->gets[0])->get();
		$this->display();
    }
	public function ajax()
    {
		if($_POST['type']=='system_sort'){
			$arrlength=count($_POST['id']);
			$ar=[];
			for($x=0;$x<$arrlength;$x++)
			{
				$ar[$x]=['id'=>$_POST['id'][$x], 'sort'=>$_POST['sort'][$x]];
			}
			
			foreach($ar as $k=>$v){
				Db::name('system')->where('id = ?',$v['id'])->update($v);
			}
			json(1);
		}
		
		if($_POST['type']=='system_del'){
			if(Db::name('system')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
	public function list()
	{
		if(UNi_POST){	
			$this->data=Db::name('system')->where('cnname like ?','%'.$_POST['key'].'%')->paginate(9)->order('sort asc')->fields();
		}else{
			$this->data=Db::name('system')->paginate(9)->order('sort asc')->fields();
		}
		$this->count=Db::name('system')->count();
		$this->display();
	}

	public function shield()
	{
		if(UNi_POST){
			Db::name('shield')->where('id = ?',1)->update(['shield'=>$_POST['shield']]);
			$this->success('修改成功');
		}
		$this->data=Db::name('shield')->where('id = ?',1)->get();
	   	$this->display();
	}
}