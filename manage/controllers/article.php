<?php
use UNI\tools\Db;
class articleController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	public function index()
    {
	  if(UNi_POST){
		   $this->data=Db::name('article')
			  ->alias('a')
			  ->join('cate c','c.id = a.cateid')
			  ->where('a.title like ?', '%'.$_POST['key'].'%')
			  ->paginate(9)->fields('a.*,c.catename');
	  }else{
		  $this->data=Db::name('article')
			  ->alias('a')
			  ->join('cate c','c.id = a.cateid')
			  ->paginate(9)->fields('a.*,c.catename');
	  }
	  $this->count=Db::name('article')->count();
	  $this->display();
		
    }
	public function add()
    {
    	if(UNi_POST){
			//表单验证
			$checkRules = [
					'title'  => ['must', '', '文章标题必须填写'],
					'cateid' =>['must', '', '分类栏目必须填写'],
					'editor' =>['must', '', '文章内容必须填写'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			if($_FILES['pic']['size'] > 0){
				$uper = new UNI\tools\uper('pic', 'article');
				$uploadedFile = $uper->upload();
				if($uploadedFile){
					$_POST['pic']='/'.$uploadedFile;
				}else{
					$this->error('图片上传失败');
				}
			}
			//规整数据
			if(!$_POST['desc']){
				$_POST['desc']=mb_substr(strip_tags(htmlspecialchars_decode($_POST['editor'])),0,200).'...';
			}
			$_POST['state']= isset($_POST['state']) ? 1 : 0 ;
			
			$_POST['keyword']=str_replace('，',',',$_POST['keyword']);
			
			$info=Db::name('article')->add($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('添加成功',2);
			}else{
				$this->error('添加失败');
			}
    	}
	  $res=Db::name('cate')->getall();
	  $this->datasort=$this->sort($res);
      $this->display();
    }
    
	public function edit()
    {
		if(UNi_POST){
			//表单验证
			$checkRules = [
					'title'  => ['must', '', '文章标题必须填写'],
					'cateid' =>['must', '', '分类栏目必须填写'],
					'editor' =>['must', '', '文章内容必须填写'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			if(!$checker->check()){
				$this->error($checker->error);	
			}
			if($_FILES['pic']['size'] > 0){
				$uper = new UNI\tools\uper('pic', 'article');
				$uploadedFile = $uper->upload();
				if($uploadedFile){
					$_POST['pic']='/'.$uploadedFile;
				}else{
					$this->error('图片上传失败');
				}
			}
			//规整数据
			if(!$_POST['desc']){
				$_POST['desc']=mb_substr(strip_tags(htmlspecialchars_decode($_POST['editor'])),0,200).'...';
			}
			$_POST['state']= isset($_POST['state']) ? 1 : 0 ;
			$_POST['keyword']=str_replace('，',',',$_POST['keyword']);
			$info=Db::name('article')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
		}
		$this->data=Db::name('article')->where('id = ?', $this->gets[0])->get();
		$res=Db::name('cate')->getall();
		$this->datasort=$this->sort($res);
		$this->display();
    }
	public function ajax()
    {
		if($_POST['type']=='article_all'){
			foreach($_POST['id'] as $v){
				Db::name('article')->where('id = ?',$v)->del();
			}
			json(1);//修改成功返回1
		}
		if($_POST['type']=='article_del'){
			if(Db::name('article')->where('id = ?',$_POST['id'])->del()){
				json(1);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
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