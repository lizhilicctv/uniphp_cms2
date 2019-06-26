<?php
use UNI\tools\Db;
class adminController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	
	public function index()
    {
    	if(UNi_POST){
			$this->data=Db::name('admin')
						  ->alias('a')
						  ->join('auth_group w','a.role = w.id')
						  ->where('username like ?','%'.$_POST['key'].'%')
						  ->paginate(10)->fields('a.*,w.title');
    	}else{
			$this->data=Db::name('admin')
						  ->alias('a')
						  ->join('auth_group w','a.role = w.id')
						  ->paginate(10)->fields('a.*,w.title');
    	}
		$this->count=Db::name('admin')->count();
    	$this->display();
    }
	 public function add()
    {
		if(UNi_POST){
    		$checkRules = [
    				'username'  => [
    					['must', '', '用户名必须填写'],
    					['string', '4,16', '用户名为 4 - 16 字符']
    				],
    				'role' =>['must', '', '用户角色必须填写'],
					'password' =>['must', '', '用户密码必须填写']
    			];
				
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			if($_POST['password'] != $_POST['password2']){
				$this->error('两次密码不一致');	
			}
			$info=[
				'username'=>$_POST['username'],
				'password'=>md5(substr(md5($_POST['password']),0,25).'lizhili'),
				'role'=>$_POST['role'],
				'mark'=>$_POST['mark'],
			];
			
			$info=Db::name('admin')->add($info);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('添加成功',2);
			}else{
				$this->error('添加失败');
			}
    	}
		$this->data=Db::name('auth_group')->getall();
		$this->display();
    }
	public function ajax()
    {
    	if($_POST['type']=='admin_all'){
    		foreach($_POST['id'] as $v){
    			Db::name('admin')->where('id = ?',$v)->del();
    		}
    		json(1);//修改成功返回1
    	}
    	if($_POST['type']=='admin_del'){
			if(Db::name('admin')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
    	}
    	if($_POST['type']=='admin_start'){
    		if(Db::name('admin')->where('id = ?',$_POST['id'])->update(['isopen'=>1])){
    			json(1);//修改成功返回1
    		}else{
    			json(0);
    		}
    	}
    	if($_POST['type']=='admin_stop'){
    		if(Db::name('admin')->where('id = ?',$_POST['id'])->update(['isopen'=>0])){
    			json(1);//修改成功返回1
    		}else{
    			json(0);
    		}
    	}
		if($_POST['type']=='log_all'){
			foreach($_POST['id'] as $v){
				Db::name('log')->where('id = ?',$v)->del();
			}
			json(1);//修改成功返回1
		}
		if($_POST['type']=='log_del'){
			if(Db::name('log')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
    	json(0);
    }
	public function edit()
    {
    	if(UNi_POST){
    		$checkRules = [
    				'username'  => [
    					['must', '', '用户名必须填写'],
    					['string', '4,16', '用户名为 4 - 16 字符']
    				],
    			];
    			
    		$checker = new UNI\tools\dataChecker($_POST, $checkRules);
    		if(!$checker->check()){
    			$this->error($checker->error);	
    		}

			//规整数据
			$info['username']=$_POST['username'];
			if(!!$_POST['password']){
				$info['password']=md5(substr(md5($_POST['password']),0,25).'lizhili');
			}
			if(isset($_POST['mark'])){
				$info['mark']=$_POST['mark'];
			}
			if(isset($_POST['role'])){
				$info['role']=$_POST['role'];
			}

			$res=Db::name('admin')->where('id = ?',$_POST['id'])->update($info);
			if($res){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
    	}
		$this->data=Db::name('admin')->where('id = ?', $this->gets[0])->get();
		$this->res=Db::name('auth_group')->getall();
		$this->display();
    }
	
	//清除缓存
	public function cahe(){
		//清除缓存
		if(cache('rm_all')){
			$this->success('清除缓存成功',2);
		}else{
			$this->error('清除缓存失败了');
		}
	}
	//日志操作
	 public function log(){
		if(UNi_POST){
				$this->data=Db::name('log')->where('username like ?','%'.$_POST['key'].'%')->paginate(15)->order('id desc')->fields();		
			}else{
				 $this->data=Db::name('log')->paginate(15)->order('id desc')->fields();
			}
			$this->count=Db::name('log')->count();
		$this->display();
	}
}