<?php
use UNI\tools\Db;
class memberController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	
	public function index()
    {
	  if(UNi_POST){
		  $this->data=Db::name('member')->where('isNull(del_time)',null)->where('username like ?', '%'.$_POST['key'].'%')->order('id desc')->paginate(9)->fields(); 
	  }else{
		  $this->data=Db::name('member')->where('isNull(del_time)',null)->order('id desc')->paginate(9)->fields(); 
	  }
	  $this->count=Db::name('member')->where('isNull(del_time)',null)->count();
	  $this->display();
    }
	
	public function add()
    {
    	if(UNi_POST){
			//表单验证
			$checkRules = [
				'username'  => ['string', '2,10', '用户名为 2 - 10 字符'],
				'sex' =>['betweend', '0,2', '性别必须填写'],
				'phone' =>[
					['phone', '', '手机填写格式不正确'],
					['must', '', '手机必须填写']
				],
				'email' =>[
					['email', '', '邮件格式不正确'],
					['must', '', '邮件必须填写']
				],
			];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			$res = $checker->check();
			if(!$res){
				$this->error($checker->error);	
			}
			//这里是数据规整
			$_POST['isopen']=1;
			$_POST['state']= isset($_POST['state']) ? 1 : 0 ;
			
			$info=Db::name('member')->add($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('添加成功',2);
			}else{
				$this->error('添加失败');
			}
    	}
      $this->display();
    }
    
	public function edit()
    {
		if(UNi_POST){
			$checkRules = [
				'username'  => ['string', '2,10', '用户名为 2 - 10 字符'],
				'sex' =>['betweend', '0,2', '性别必须填写'],
				'phone' =>[
					['phone', '', '手机填写格式不正确'],
					['must', '', '手机必须填写']
				],
				'email' =>[
					['email', '', '邮件格式不正确'],
					['must', '', '邮件必须填写']
				],
			];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			$res = $checker->check();
			if(!$res){
				$this->error($checker->error);	
			}
			//这里是数据规整
			$_POST['isopen']=1;
			$_POST['state']= isset($_POST['state']) ? 1 : 0 ;
			
			$info=Db::name('member')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
		}

		$this->data=Db::name('member')->where('id = ?', $this->gets[0])->get();
		$this->display();
    }
	public function ajax()
    {
		if($_POST['type']=='member_all'){
			foreach($_POST['id'] as $v){
				Db::name('member')->where('id = ?',$v)->update(['del_time'=>time()]);
			}
			json(1);//修改成功返回1
		}
		if($_POST['type']=='member_del'){

			if(Db::name('member')->where('id = ?',$_POST['id'])->update(['del_time'=>time()])){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
			
		}
		if($_POST['type']=='member_start'){
			if(Db::name('member')->where('id = ?',$_POST['id'])->update(['isopen'=>1])){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		if($_POST['type']=='member_stop'){
			if(Db::name('member')->where('id = ?',$_POST['id'])->update(['isopen'=>0])){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		if($_POST['type']=='member_zhongdel'){
			if(Db::name('member')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		if($_POST['type']=='member_huanyuan'){
			if(Db::name('member')->where('id = ?',$_POST['id'])->update(['del_time'=>null])){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
	public function shan()
	{
		if(UNi_POST){
			$this->data=Db::name('member')->where('del_time <> ?','')->where('username like ?', '%'.$_POST['key'].'%')->order('id desc')->paginate(9)->fields(); 
		}else{
			$this->data=Db::name('member')->where('del_time <> ?','')->order('id desc')->paginate(9)->fields(); 
		}
		$this->count=Db::name('member')->where('del_time <> ?','')->count();
	   	$this->display();
	}
	public function password()
    {
    	if(UNi_POST){
			if($_POST['password'] != $_POST['password2']){
				//$this->error('两次密码不一致');
				echo '<script>alert("两次密码不一致！");history.go(-1)</script>';
				die;
			}
			$res=Db::name('member')->where('id = ?',$_POST['id'])->update(['password'=>md5($_POST['password'])]);
			if($res){
				echo '<script>alert("修改成功了！");parent.location.reload()</script>';
				die;
				//$this->success('修改成功',2);
			}else{
				echo '<script>alert("修改失败了！");history.go(-1)</script>';
				die;
				//$this->error('修改失败');
			}

			
    	}
		
		$this->data=Db::name('member')->where('id = ?', $this->gets[0])->get();
      	$this->display();
    }
	
	
	
	
	
	
}