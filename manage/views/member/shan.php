<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>用户管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 
		<form action="" method="post">
			<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="key">
			<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			
			
		</span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="40">性别</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="">地址</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->data[0] as $k=>$v){ ?>
			<tr class="text-c">
				<td><?php echo $v['id']; ?></td>
				<td><?php echo $v['username']; ?></td>
				<td>
					<?php if($v['sex'] == 1){ ?>
						男
					<?php }elseif($v['sex'] == 2){ ?>
						女
					<?php }else{ ?>
						未知
					<?php } ?>
				</td>
				<td><?php echo $v['phone'] ?? '尚未填写'; ?></td>
				<td><?php echo $v['email'] ?? '尚未填写'; ?></td>
				<td class="text-l">
					<?php
						if($v['sheng'] or $v['shi'] or $v['xian'] or $v['address']){
							echo $v['sheng'].'&nbsp;'.$v['shi'].'&nbsp;'.$v['xian'].'&nbsp; &nbsp;'.$v['address'];
						}else{
							echo '暂未填写';
						}
					?> 
				</td>
				<td><?php echo date('Y-m-d H:i:s',$v['up_time']); ?></td>
				<td class="td-status">
					<span class="label label-danger radius">已删除</span>
				</td>
				<td class="td-manage">
					<a style="text-decoration:none" href="javascript:;" onClick="member_huanyuan(this,<?php echo $v['id']; ?>)" title="还原"><i class="Hui-iconfont">&#xe66b;</i></a> 
					<a title="删除" href="javascript:;" onclick="member_zhongdel(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php echo $this->data[1]; ?>
	</div>
</div>
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">


/*管理员-还原*/
function member_huanyuan(obj,id){
	layer.confirm('确认要还原吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('member','ajax');?>",
		{
			id:id,
			type:'member_huanyuan',
		},
		function(result){
			console.log(result);
	        if(result===0){
	        	layer.msg('还原失败!',{icon: 5,time:1000});
	        }else{
	        	$(obj).parents("tr").remove();
				layer.msg('已还原!',{icon: 1,time:1000});
	        }
	    });	
	});
}


/*管理员-删除*/
function member_zhongdel(obj,id){
	layer.confirm('删除后将无法恢复，确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('member','ajax');?>",
		{
			id:id,
			type:'member_zhongdel',
		},
		function(result){
			console.log(result);
	        if(result===0){
	        	layer.msg('删除失败!',{icon: 5,time:1000});
	        }else{
	        	$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
	        }
	    });	
	});
}

</script> 
</body>
</html>