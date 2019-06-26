<?php
use UNI\tools\Db;
class AuthGroupController extends uni
{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
    public function index()
    {
		$this->data=Db::name('auth_group')->order('sort','ASC')->getall();
		$this->count=Db::name('auth_group')->count();
		$this->display();
    }
	public function ajax()
    {
    	if($_POST['type']=='AuthGroup_start' and $_POST['id'] != 1){
    		if(Db::name('auth_group')->where('id = ?',$_POST['id'])->update(['status'=>1])){
    			json(1);//修改成功返回1
    		}else{
    			json(0);
    		}
    	}
    	if($_POST['type']=='AuthGroup_stop' and $_POST['id'] != 1){
    		if(Db::name('auth_group')->where('id = ?',$_POST['id'])->update(['status'=>0])){
    			json(1);//修改成功返回1
    		}else{
    			json(0);
    		}
    	}
		if($_POST['type']=='AuthGroup_sort'){
			$arrlength=count($_POST['id']);
			$ar=[];
			for($x=0;$x<$arrlength;$x++)
			{
				$ar[$x]=['id'=>$_POST['id'][$x], 'sort'=>$_POST['sort'][$x]];
			}
			
			foreach($ar as $k=>$v){
				Db::name('auth_group')->where('id = ?',$v['id'])->update($v);
			}
			json(1);
		}
		
		if($_POST['type']=='AuthGroup_del'){
			if(Db::name('auth_group')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
	public function add()
    {
    	if(UNi_POST){
			if(!$_POST['title']){
				$this->error('角色名称必须填写!');
			}
			if(isset($_POST['rules'])){
				$_POST['rules']=implode(",",array_unique($_POST['rules']));
			}
			
    		$info=Db::name('auth_group')->add($_POST);
    		if($info){
    			//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
    			$this->success('添加成功',2);
    		}else{
    			$this->error('添加失败');
    		}
    	}

		$res=Db::name('auth_rule')->order('sort asc')->getall();
		$this->datasort=$this->sort($res);
		$this->display();
    }
	public function edit()
    {
    	if(UNi_POST){
    		if(!$_POST['title']){
    			$this->error('角色名称必须填写!');
    		}
    		if(isset($_POST['rules'])){
    			$_POST['rules']=implode(",",array_unique($_POST['rules']));
    		}
    		
    		$info=Db::name('auth_group')->where('id = ?',$_POST['id'])->update($_POST);
    		if($info){
    			//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
    			$this->success('修改成功',2);
    		}else{
    			$this->error('修改失败');
    		}
    	}
		$this->data=Db::name('auth_group')->where('id = ?', $this->gets[0])->get();
		$res=Db::name('auth_rule')->order('sort asc')->getall();
		$this->datasort=$this->sort($res);
		$this->display();
    }
	//递归排序
	public function sort($res,$fid=0,$level=0){
		static $arr=[];//这样需要学习一下
		foreach ($res as $key => $value) {
			if($value['fid']==$fid){
				$value['level']=$level;
				$arr[]=$value;
				$this->sort($res,$value['id'],$level+1);
			}
		}
		return $arr;
	}
}
