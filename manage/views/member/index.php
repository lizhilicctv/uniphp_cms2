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
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="data_del()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','<?php echo u('member','add'); ?>','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
	<h4>默认密码为：<b>123456</b></h4>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="all" value=""></th>
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
				<td><input type="checkbox" class="all" value="<?php echo $v['id']; ?>" name=""></td>
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
					<?php if($v['isopen'] == 1){ ?>
						<span class="label label-success radius">已启用</span>
					<?php }else{ ?>
						<span class="label label-default radius">已禁用</span>
					<?php } ?>
				</td>
				<td class="td-manage">
					<?php if($v['isopen'] == 1){ ?>
						<a style="text-decoration:none" onClick="member_stop(this,<?php echo $v['id']; ?>)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
					<?php }else{ ?>
						<a onClick="member_start(this,<?php echo $v['id']; ?>)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>
					<?php } ?>
					<a title="编辑" href="javascript:;" onclick="member_edit('编辑','<?php echo u('member','edit',$v['id']); ?>','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','<?php echo u('member','password',$v['id']); ?>','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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

/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}

/*管理员-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('member','ajax');?>",
		{
			id:id,
			type:'member_stop',
		},
		function(result){
	        if(result===0){
	        	layer.msg('停用失败!',{icon: 5,time:1000});
	        }else{
	        	$(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_start(this,{ $vo.id})" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
				$(obj).remove();
				layer.msg('已停用!',{icon: 5,time:1000});
	        }
	    });	
	});
}

/*管理员-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('member','ajax');?>",
		{
			id:id,
			type:'member_start',
		},
		function(result){
	        if(result===0){
	        	layer.msg('启动失败!',{icon: 5,time:1000});

	        }else{
	        	$(obj).parents("tr").find(".td-manage").prepend('<a onClick="member_stop(this,{ $vo.id})" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!', {icon: 6,time:1000});
	        }
	    });
	});
}

/*管理员-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('member','ajax');?>",
		{
			id:id,
			type:'member_del',
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
/*自己编写管理员-批量删除*/
function data_del(){
	var arr= new Array();
	$("input[type='checkbox']:gt(0):checked").each(function(){
    	arr.push($(this).attr("value"));
 });
   if(arr.length<1){
    layer.msg('至少选择一个',{icon:5,time:1000});
   }else{
	   	layer.confirm('确认要删除吗？',function(index){
			$.post(
				"<?php echo u('member','ajax');?>",
			{
				id:arr,
				type:'member_all',
			},
			function(result){
		        if(result===0){
		        	layer.msg('批量删除失败!',{icon: 5,time:1000});
		        }else{
					layer.msg('批量删除成功!',{icon:1,time:1000});
					history.go(0);
		        }
		    });	
		});
   }
}
</script> 
</body>
</html>