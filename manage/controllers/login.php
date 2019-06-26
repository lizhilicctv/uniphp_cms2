<?php
use UNI\tools\Db;
class loginController extends uni{

	 public function index()
	{
		if(UNi_POST){
			$ip=$this->getIp();
			if($_POST['coder'] != getSession('UNIVcode')){
                return $this->error('验证码输入错误');
            }
			$log1=[
				'username'=>$_POST['username'],
				'ip'=>$ip,
				'in_time'=>time()
			];
			Db::name('log')->add($log1);
			$info=Db::name('admin')->where('username = ?',$_POST['username'])->get();
			if($info){
				if(md5(substr(md5($_POST['password']),0,25).'lizhili')==$info['password']){
					if($info['isopen']==1){
						setSession('admin_name', $info['username']);
						setSession('admin_id', $info['id']);
						return $this->success('登陆成功',u('index','index'));
					}else{
						return $this->error('用户名或密码错误'); //账号已经关闭
					}
				}else{
					return $this->error('用户名或密码错误'); //密码错误
				}
			}else{
				return $this->error('用户名或密码错误');//用户名不存在
			}
			die;
		}
		$this->display();
	}
	public function out()
	{
		removeSession('admin_name');
		removeSession('admin_id');
		return $this->success('退出成功',u('login','index'));
	}
	
	 public function getIp()
	{
	    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
	    {
	        $cip = $_SERVER["HTTP_CLIENT_IP"];
	    }
	    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	    {
	        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }
	    else if(!empty($_SERVER["REMOTE_ADDR"]))
	    {
	        $cip = $_SERVER["REMOTE_ADDR"];
	    }
	    else
	    {
	        $cip = '';
	    }
	    preg_match("/[\d\.]{7,15}/", $cip, $cips);
	    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
	    unset($cips);
	    return $cip;
	}
	 //绘制验证码
    public function vcode(){
        $vcode = new uni\tools\verifyCode(150, 40, 4, 1);
        $vcode->fontSize  = 30; //验证码文字大小
        $vcode->noiseNumber = 10; //干扰字符数量
        //绘制验证码
        $vcode->draw();    
    }
}