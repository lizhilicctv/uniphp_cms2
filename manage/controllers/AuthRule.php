<?php
use UNI\tools\Db;
class AuthRuleController extends uni
{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
    public function index()
    {
    	if(isset($this->gets[0])){
			$res=Db::name('auth_rule')->order('sort asc')->page($this->gets[0],10)->getall();
		}else{
			$res=Db::name('auth_rule')->order('sort asc')->page(1,10)->getall();
		}
		
		
		
    	$this->datasort=$this->sort($res);
    	$this->count=Db::name('auth_rule')->count();
		$this->page=ceil($this->count/10);
		$this->display();
    }
	
	public function ajax()
    {
    	if($_POST['type']=='AuthRule_sort'){
    		$arrlength=count($_POST['id']);
    		$ar=[];
    		for($x=0;$x<$arrlength;$x++)
    		{
    			$ar[$x]=['id'=>$_POST['id'][$x], 'sort'=>$_POST['sort'][$x]];
    		}
    		foreach($ar as $k=>$v){
    			Db::name('auth_rule')->where('id = ?',$v['id'])->update($v);
    		}
    		json(1);
    	}
    	if($_POST['type']=='AuthRule_del'){
			if(Db::name('auth_rule')->where('id = ?',$_POST['id'])->del()){
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
    		//表单验证
    		$checkRules = [
    				'title'  => [
						['string', '4,16', '权限名称为 4 - 16 字符'],
						['must', '', '权限名称必须填写']
					],
    				'name' =>['must', '', '权限地址必须填写'],
    			];
    			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
    			$res = $checker->check();
    		if(!$res){
    			$this->error($checker->error);	
    		}
    		$info=Db::name('auth_rule')->add($_POST);
    		if($info){
    			//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
    			$this->success('添加成功',2);
    		}else{
    			$this->error('添加失败');
    		}
    	}
		$this->datasort=Db::name('auth_rule')->where('fid = ?',0)->order('sort asc')->getall();
		$this->display();
    }
	public function edit()
    {
    	if(UNi_POST){
    		//表单验证
    		$checkRules = [
    				'title'  => [
    					['string', '4,16', '权限名称为 4 - 16 字符'],
    					['must', '', '权限名称必须填写']
    				],
    				'name' =>['must', '', '权限地址必须填写'],
    			];
    			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
    			$res = $checker->check();
    		if(!$res){
    			$this->error($checker->error);	
    		}
			
			$info=Db::name('auth_rule')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
    	}
		$this->data=Db::name('auth_rule')->where('id = ?', $this->gets[0])->get();
		$this->datasort=Db::name('auth_rule')->where('fid = ?',0)->order('sort asc')->getall();
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
