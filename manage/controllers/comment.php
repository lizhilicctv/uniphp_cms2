<?php
use UNI\tools\Db;
class commentController extends uni{
	//前置操作
	public function __init(){
		parent::__init();
		model('manage')->isLogin(); //自动执行 构造方法
	}
	public function index()
    {
	  if(UNi_POST){
		  $this->data=Db::name('comment')
			  ->alias('c')
			  ->join('member m','c.member_id = m.id')
			  ->where('c.content like ?', '%'.$_POST['key'].'%')
			  ->paginate(9)->fields('c.*,m.username');
	  }else{
		  $this->data=Db::name('comment')
			  ->alias('c')
			  ->join('member m','c.member_id = m.id')
			  ->paginate(9)->fields('c.*,m.username');
	  }
	  $this->count=Db::name('comment')->count();
	  $this->display();
		
    }

    
	public function edit()
    {
		if(UNi_POST){
			$info=Db::name('comment')->where('id = ?',$_POST['id'])->update($_POST);
			if($info){
				
				$liu=Db::name('comment')->where('isopen = ?','-1')->count();
				if($liu!=0){
					echo '<script>parent.parent.document.getElementById("lizhili_ping").innerHTML="评',$liu,'"</script>';
				}else{
					echo '<script>parent.parent.document.getElementById("lizhili_ping").innerHTML="评"</script>';
				}

				
				//echo '<script>alert("你好，添加成功了！");parent.location.reload()</script>';
				$this->success('修改成功',2);
			}else{
				$this->error('修改失败');
			}
		}
		$this->data=Db::name('comment')
		->alias('c')
		->join('member m','c.member_id = m.id')
		->where('c.id = ?', $this->gets[0])->get('c.*,m.username');
		$this->display();
    }
	
	public function ajax()
    {
		if($_POST['type']=='comment_all'){
			foreach($_POST['id'] as $v){
				Db::name('comment')->where('id = ?',$v)->del();
			}
			json([1,Db::name('comment')->where('isopen = ?',-1)->count()]);//修改成功返回1
		}
		
		if($_POST['type']=='comment_del'){
			if(Db::name('comment')->where('id = ?',$_POST['id'])->del()){
				json([1,Db::name('comment')->where('isopen = ?',-1)->count()]);//修改成功返回1
			}else{
				json(0);
			}
		}
		json(0);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}