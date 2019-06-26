<?php
use UNI\tools\Db;
class adpositionController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	
	public function index()
    {
	  if(UNi_POST){
		  $this->data=Db::name('adposition')->paginate(9)->where('ad_title like ?', '%'.$_POST['key'].'%')->order('sort asc')->fields();
	  }else{
		  $this->data=Db::name('adposition')->paginate(9)->order('sort asc')->fields();
	  }
	  $this->count=Db::name('adposition')->count();
	  $this->display();
    }
	
	public function add()
    {
    	if(UNi_POST){
			//表单验证
			$checkRules = [
					'ad_title'  => ['string', '2,30', '广告名称为 2 - 30 字符'],
					'url' =>['url', '', '网站链接格式填写不正确'],
				];
				$checker = new UNI\tools\dataChecker($_POST, $checkRules);
				$res = $checker->check();
			if(!$res){
				$this->error($checker->error);	
			}
			if($_FILES['pic']['size'] > 0){
				$uper = new UNI\tools\uper('pic', 'ad');
				$uploadedFile = $uper->upload();
				if($uploadedFile){
					$_POST['pic']='/'.$uploadedFile;
				}else{
					$this->error($uper->error);
				}
			}else{
				$this->error('广告图片没有上传！');
			}
			//规整数据
			$_POST['isopen']= isset($_POST['isopen']) ? 1 : 0 ;
			
			$info=Db::name('adposition')->add($_POST);
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
				'ad_title'  => ['string', '2,30', '广告名称为 2 - 30 字符'],
				'url' =>['url', '', '网站链接格式填写不正确'],
			];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			$res = $checker->check();
		if(!$res){
			$this->error($checker->error);	
		}
		if($_FILES['pic']['size'] > 0){
			$uper = new UNI\tools\uper('pic', 'ad');
			$uploadedFile = $uper->upload();
			if($uploadedFile){
				$_POST['pic']='/'.$uploadedFile;
			}else{
				$this->error($uper->error);
			}
		}else{
			$this->error('广告图片没有上传！');
		}
		//规整数据
		$_POST['isopen']= isset($_POST['isopen']) ? 1 : 0 ;
		
		$info=Db::name('adposition')->where('id = ?',$_POST['id'])->update($_POST);
		if($info){
			//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
			$this->success('修改成功',2);
		}else{
			$this->error('修改失败');
		}
    }

		$this->data=Db::name('adposition')->where('id = ?', $this->gets[0])->get();
      $this->display();
    }
	public function ajax()
    {
		if($_POST['type']=='adposition_sort'){
			$arrlength=count($_POST['id']);
			$ar=[];
			for($x=0;$x<$arrlength;$x++)
			{
				$ar[$x]=['id'=>$_POST['id'][$x], 'sort'=>$_POST['sort'][$x]];
			}
			foreach($ar as $k=>$v){
				Db::name('adposition')->where('id = ?',$v['id'])->update($v);
			}
			json(1);
		}
		if($_POST['type']=='adposition_del'){
			if(Db::name('adposition')->where('fid = ?',$_POST['id'])->get()){
				json(2); //下级有东西不能删除
			}else{
				if(Db::name('adposition')->where('id = ?',$_POST['id'])->del()){
					json(1);//修改成功返回1
				}else{
					json(0);
				}
			}
		}
		if($_POST['type']=='adposition_start'){
			if(Db::name('adposition')->where('id = ?',$_POST['id'])->update(['isopen'=>1])){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		if($_POST['type']=='adposition_stop'){
			if(Db::name('adposition')->where('id = ?',$_POST['id'])->update(['isopen'=>0])){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
}