<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>角色管理 - 管理员管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>


	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="catesort()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 角色排序</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php echo u('AuthGroup','add'); ?>','900')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
			<div class="mt-10">
			<table class="table table-border table-bordered table-hover table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="7">角色管理</th>
					</tr>
					<tr class="text-c">
						<th width="40">ID</th>
						<th width="55">排序</th>
						<th width="200">角色名</th>
						<th width="700">描述</th>
						<th width="80">是否已启用</th>
						<th width="80">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($this->data as $k=>$v){ ?>
					<tr class="text-c">
						<td><?php echo $v['id']; ?></td>
						<td><input type="text" name="<?php echo $v['id']; ?>" class="input-text lizhi"  value="<?php echo $v['sort']; ?>"></td>
						<td><?php echo $v['title']; ?></td>
						<td><?php echo $v['desc']; ?></td>
						<td class="td-status">
							<?php if($v['status'] == 1){ ?>
								<span class="label label-success radius">已启用</span>
							<?php }else{ ?>
								<span class="label label-default radius">已禁用</span>
							<?php } ?>
						</td>
						<td class="td-manage">
							<?php
								if($v['id'] != 1){
									 if($v['status'] == 1){ ?>
										<a style="text-decoration:none" onClick="admin_stop(this,<?php echo $v['id']; ?>)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
									<?php }else{ ?>
										<a onClick="admin_start(this,<?php echo $v['id']; ?>)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>
									<?php } 
								}
							?>
							
							<a title="编辑" href="javascript:;" onclick="admin_role_edit('管理员编辑','<?php echo u('AuthGroup','edit',$v['id']); ?>','1','1000')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
							<?php if($v['id'] != 1){ ?>
								<a title="删除" href="javascript:;" onclick="admin_role_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		
			</div>
		</article>
	</div>


<!--_footer 作为公共模版分离出去--> 
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--/_footer /作为公共模版分离出去--> 

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('AuthGroup','ajax');?>",
		{
			id:id,
			type:'AuthGroup_del',
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
//自己编写更新排序

function catesort(){
	layer.confirm('确认要更新排序吗？',function(index){	
	 	var x=document.getElementsByClassName("lizhi");
	 	var sortarr= new Array();
	 	var idarr= new Array();
	 	for(var i=0;i<x.length;i++){
	 		sortarr.push(x[i].value);
	 		idarr.push(x[i].name);
	 	}
		$.post(
			"<?php echo u('AuthGroup','ajax');?>",
		{
			'sort':sortarr,
			'id':idarr,
			type:'AuthGroup_sort',
		},
		function(result){
			//console.log(result);
	        if(result===1){
	        	layer.msg('更新成功!',{icon:1,time:1000});
	        	history.go(0);
	        }else{
				layer.msg('更新失败!',{icon: 5,time:1000});
				history.go(0);
	        }
	    });	
	});
}

/*角色-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('AuthGroup','ajax');?>",
		{
			id:id,
			type:'AuthGroup_stop',
		},
		function(result){
	        if(result===0){
	        	layer.msg('停用失败!',{icon: 5,time:1000});
	        }else{
	        	$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,{$data.id})" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
				$(obj).remove();
				layer.msg('已停用!',{icon: 5,time:1000});
	        }
	    });	
	});
}

/*角色-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('AuthGroup','ajax');?>",
		{
			id:id,
			type:'AuthGroup_start',
		},
		function(result){
	        if(result===0){
	        	layer.msg('启动失败!',{icon: 5,time:1000});

	        }else{
	        	$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,{$data.id})" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!', {icon: 6,time:1000});
	        }
	    });
	});
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>