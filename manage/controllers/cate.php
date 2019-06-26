<?php
use UNI\tools\Db;
class cateController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	
	
	public function index()
    {
	  if(UNi_POST){
		  $res=Db::name('cate')->where('catename like ?', '%'.$_POST['key'].'%')->order('sort asc,id asc')->getall();
		  $this->datasort=$this->sort($res);
	  }else{
		  $res=Db::name('cate')->order('sort asc,id asc')->getall();
		  $this->datasort=$this->sort($res);
	  }
	  
	  $this->count=Db::name('cate')->count();
	  $this->display();
		
    }
	
	public function add()
    {
    	if(UNi_POST){	
			//表单验证
			$checkRules = [
					'catename'  => ['string', '2,10', '栏目名称为 2 - 10 字符'],
					'en_name' =>['must', '', '英文名称必须填写'],
				];
			$checker = new UNI\tools\dataChecker($_POST, $checkRules);
			$res = $checker->check();
			if(!$res){
				$this->error($checker->error);	
			}
			$info=Db::name('cate')->add($_POST);
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
                'catename'  => ['string', '2,10', '栏目名称为 2 - 10 字符'],
				'en_name' =>['must', '', '英文名称必须填写'],
            ];
            $checker = new UNI\tools\dataChecker($_POST, $checkRules);
            $res = $checker->check();
		if(!$res){
			$this->error($checker->error);	
		}

		$info=Db::name('cate')->where('id = ?',$_POST['id'])->update($_POST);
		if($info){
			//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
			$this->success('修改成功',2);
		}else{
			$this->error('修改失败');
		}
    }

		$this->data=Db::name('cate')->where('id = ?', $this->gets[0])->get();
		$res=Db::name('cate')->getall();
		$this->datasort=$this->sort($res);
		$this->display();
    }
	public function ajax()
    {
		
		if($_POST['type']=='cate_sort'){
			$arrlength=count($_POST['id']);
			$ar=[];
			for($x=0;$x<$arrlength;$x++)
			{
				$ar[$x]=['id'=>$_POST['id'][$x], 'sort'=>$_POST['sort'][$x]];
			}
			foreach($ar as $k=>$v){
				Db::name('cate')->where('id = ?',$v['id'])->update($v);
			}
			json(1);
		}
		if($_POST['type']=='cate_del'){
			if(Db::name('cate')->where('fid = ?',$_POST['id'])->get()){
				json(2); //下级有东西不能删除
			}else{
				if(Db::name('cate')->where('id = ?',$_POST['id'])->del()){
					json(1);//修改成功返回1
				}else{
					json(0);
				}
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