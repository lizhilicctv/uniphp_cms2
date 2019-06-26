<?php
use UNI\tools\Db;
class messageController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	public function index()
    {
	  if(UNi_POST){
		  $this->data=Db::name('message')
			  ->paginate(9)
			  ->where('title like ?', '%'.$_POST['key'].'%')
			  ->fields();
	  }else{
		  $this->data=Db::name('message')
			  ->paginate(9)->fields();
	  }
	  $this->count=Db::name('message')->count();
	  $this->display();
		
    }
	public function edit()
    {
		if(UNi_POST){
			$info=Db::name('message')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$liu=Db::name('message')->where('isopen = ?','0')->count();
				if($liu!=0){
					echo '<script>parent.parent.document.getElementById("lizhili_liu").innerHTML="留',$liu,'"</script>';
				}else{
					echo '<script>parent.parent.document.getElementById("lizhili_liu").innerHTML="留"</script>';
				}
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
		}
		$this->data=Db::name('message')->where('id = ?', $this->gets[0])->get();
		$this->display();
    }
	
	public function ajax()
    {

		if($_POST['type']=='message_del'){
			if(Db::name('message')->where('id = ?',$_POST['id'])->del()){
				json([1,Db::name('message')->where('isopen = ?',0)->count()]);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}