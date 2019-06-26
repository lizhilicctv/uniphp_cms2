<?php
use UNI\tools\Db;
class slideController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	public function index()
    {
	  if(UNi_POST){
		   $this->data= $this->data=Db::name('slide')
			  ->paginate(9)
			  ->where('title like ?', '%'.$_POST['key'].'%')
			  ->order('sort asc,id desc')
			  ->fields();
	  }else{
		  $this->data=Db::name('slide')
			  ->paginate(9)
			  ->order('sort asc,id desc')
			  ->fields();
	  }
	  $this->count=Db::name('slide')->count();
	  $this->display();
		
    }
	public function add()
    {
    	if(UNi_POST){
			//表单验证
			$checkRules = [
					'title'  => ['must', '', '友情链接标题必须填写'],
					'url' =>['url', '', '网站地址格式不正确'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			if($_FILES['img']['size'] > 0){
				$uper = new UNI\tools\uper('img', 'slide');
				$uploadedFile = $uper->upload();
				if($uploadedFile){
					$_POST['img']='/'.$uploadedFile;
				}else{
					$this->error('图片上传失败');
				}
			}
			//规整数据
			$_POST['isopen']= isset($_POST['isopen']) ? 1 : 0 ;
			
			$info=Db::name('slide')->add($_POST);
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
			//表单验证
			$checkRules = [
					'title'  => ['must', '', '友情链接标题必须填写'],
					'url' =>['url', '', '网站地址格式不正确'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			if($_FILES['img']['size'] > 0){
				$uper = new UNI\tools\uper('img', 'slide');
				$uploadedFile = $uper->upload();
				if($uploadedFile){
					$_POST['img']='/'.$uploadedFile;
				}else{
					$this->error('图片上传失败');
				}
			}
			//规整数据
			$_POST['isopen']= isset($_POST['isopen']) ? 1 : 0 ;
			
			$info=Db::name('slide')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
		}
		$this->data=Db::name('slide')->where('id = ?', $this->gets[0])->get();
		$this->display();
    }
	public function ajax()
    {
		if($_POST['type']=='slide_sort'){
			$arrlength=count($_POST['id']);
			$ar=[];
			for($x=0;$x<$arrlength;$x++)
			{
				$ar[$x]=['id'=>$_POST['id'][$x], 'sort'=>$_POST['sort'][$x]];
			}
			
			foreach($ar as $k=>$v){
				Db::name('slide')->where('id = ?',$v['id'])->update($v);
			}
			json(1);
		}
		
		if($_POST['type']=='slide_del'){
			if(Db::name('slide')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}