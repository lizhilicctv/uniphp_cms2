<?php
namespace UNI\tools;
class Auth{
     //默认配置
    protected $_config = array(
        'auth_on'           => true,                      // 认证开关
        'auth_type'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => '__AUTH_GROUP__',        // 用户组数据表名
        'auth_group_access' => 'auth_access', // 用户-用户组关系表
        'auth_rule'         => 'auth_rule',         // 权限规则表
        'auth_user'         => 'member'             // 用户信息表
    );
    public function __construct() {
    }
    /**
     * 检查权限
     * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
     * @param uid  int           认证用户的id
     * @param string mode        执行check的模式
     * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
     * @return boolean           通过验证返回true;失败返回false
     */
    public function check($name, $uid, $type=1, $mode='url', $relation='or') {
        if (!$this->_config['auth_on'])  return true;
        $authList = $this->getAuthList($uid,$type); //获取用户需要验证的所有有效规则列表
        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {
                $name = array($name);
            }
        }
		
        $list = array(); //保存验证通过的规则名
        if ($mode=='url') {
            $REQUEST = unserialize( strtolower(serialize($_REQUEST)) );
        }
		$name = explode("/",$name[0]);
        foreach ( $authList as $auth ) {
            $query = preg_replace('/^.+\?/U','',$auth);
			$query=explode("/",$query);
			if(strpos($query[0],"_")){
				$query[0]=str_replace("_","",$query[0]);
			}
			if($query[1]=='all'){
				if($query[0]==$name[0]){
					return true;
				}
			}else{
				if($query[0]==$name[0] and $query[1]==$name[1]){
					return true;
				}
			}
		}
        return false;
    }
	//检查是否有删除权限
	public function delAuth($name, $uid, $type=1, $mode='url', $relation='or') {
	    if (!$this->_config['auth_on']) return true;
	    $authList = $this->getAuthList($uid,$type); //获取用户需要验证的所有有效规则列表
	    if (is_string($name)) {
	        $name = strtolower($name);
	        if (strpos($name, ',') !== false) {
	            $name = explode(',', $name);
	        } else {
	            $name = array($name);
	        }
	    }
	    $list = array(); //保存验证通过的规则名
	    if ($mode=='url') {
	        $REQUEST = unserialize( strtolower(serialize($_REQUEST)) );
	    }
		$name = explode("/",$name[0]);
	    foreach ( $authList as $auth ) {
	        $query = preg_replace('/^.+\?/U','',$auth);
			$query=explode("/",$query);
			if($query[1]=='all' and $query[0]==$name[0]){
				return true;
			}
		}
	    return false;
	}
    /**
     * 根据用户id获取用户组,返回值为数组
     * @param  uid int     用户id
     * @return array       用户所属的用户组 array(
     *     array('uid'=>'用户id','group_id'=>'用户组id','title'=>'用户组名称','rules'=>'用户组拥有的规则id,多个,号隔开'),
     *     ...)
     */
    public function getGroups($uid) {
        static $groups = array();
        if (isset($groups[$uid]))
            return $groups[$uid];
        $user_groups = Db::name('auth_access')
            ->alias('a')
            ->join("auth_group g", "g.id=a.group_id")
            ->where("a.uid= ? and g.status=?",[$uid ,1])
            ->getall('a.uid,a.group_id,g.title,g.rules');
        $groups[$uid] = $user_groups ? $user_groups : array();
        return $groups[$uid];
    }
    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type
     */
    protected function getAuthList($uid,$type) {
        static $_authList = array(); //保存用户验证通过的权限列表
        $t = implode(',',(array)$type);
        if (isset($_authList[$uid.$t])) {
            return $_authList[$uid.$t];
        }
        if( $this->_config['auth_type']==2 && isset($_SESSION['_auth_list_'.$uid.$t])){
            return $_SESSION['_auth_list_'.$uid.$t];
        }
        //读取用户所属用户组
        $groups = $this->getGroups($uid);
        $ids = array();//保存用户所属用户组设置的所有权限规则id
        foreach ($groups as $g) {
            $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
        }
        $ids = array_unique($ids);
		
        if (empty($ids)) {
            $_authList[$uid.$t] = array();
            return array();
        }
		$ids=implode(",", $ids);
        //读取用户组所有权限规则
        $rules = Db::name($this->_config['auth_rule'])->where('id in ('.$ids.') and type = ? and status = ?',[$type,1])->getall('tiao,name');
        //循环规则，判断结果。
        $authList = array();   //
        foreach ($rules as $rule) {
            if (!empty($rule['condition'])) { //根据condition进行验证
                $user = $this->getUserInfo($uid);//获取用户信息,一维数组
                $command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
                //dump($command);//debug
                @(eval('$condition=(' . $command . ');'));
                if ($condition) {
                    $authList[] = strtolower($rule['name']);
                }
            } else {
                //只要存在就记录
                $authList[] = strtolower($rule['name']);
            }
        }
        $_authList[$uid.$t] = $authList;
        if($this->_config['auth_type']==2){
            //规则列表结果保存到session
            $_SESSION['_auth_list_'.$uid.$t]=$authList;
        }
        return array_unique($authList);
    }
    /**
     * 获得用户资料,根据自己的情况读取数据库
     */
    protected function getUserInfo($uid) {
        static $userinfo=array();
        if(!isset($userinfo[$uid])){
            $userinfo[$uid]=\think\Db::name($this->_config['auth_user'])->where(array('uid'=>$uid))->find();
        }
        return $userinfo[$uid];
    }
}