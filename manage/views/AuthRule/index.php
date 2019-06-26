<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>权限管理 - 管理员管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>

	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="catesort()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 更新排序</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','<?php echo u('AuthRule','add'); ?>','900','610')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="7">权限节点</th>
					</tr>
					<tr class="text-c">
						
						<th width="40">ID</th>
						<th width="100">排序</th>
						<th width="500">权限名称</th>
						<th width="500">字段名</th>
						<th width="200">级别</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach($this->datasort as $k=>$v){ ?>
					<tr class="text-c">
						<td><?php echo $v['id']; ?></td>
						<td><input type="text" name="<?php echo $v['id']; ?>" class="input-text lizhi"  value="<?php echo $v['sort']; ?>"></td>
						<td class="text-l" style="padding-left: 20px;">
								<?php if(isset($v['level'])){echo str_repeat("|--",$v['level']);}?><?php echo $v['title']; ?>
						</td>
						<td><?php echo $v['name']; ?></td>
						<td><?php echo $v['level']; ?>级别</td>
						<td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑','<?php echo u('AuthRule','edit',$v['id']); ?>','900','610')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<!-- 分页 -->
			<?php for($i=1;$i<=$this->page;$i++){ ?>
			<div id="lizhi12">
				<a href="<?php echo u('AuthRule','index',$i); ?>"><?php echo $i; ?></a>
			</div>
				
			<?php } ?>
			
			
		</article>
	</div>


<!--_footer 作为公共模版分离出去--> 
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--/_footer /作为公共模版分离出去--> 
<style>
	#lizhi12{
		margin: 20px 10px;
	}
	#lizhi12 a{
		display: inline-block;
		border: 1px solid #F2F2F2;
		font-size: 18px;
		padding: 0 8px;
		margin: 0 5px;
		float: left;
		text-decoration: none;
		background: #88c5f4;
		color: #FFFFFF;
		border-radius: 5px;
	}
	#lizhi12 a:hover{
		background: #4898D5;
		color: #FFFFFF;
	}
</style>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_permission_edit(title,url,w,h){
	layer_show(title,url,w,h);
}

/*管理员-权限-删除*/
function admin_permission_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		$.post(
			"<?php echo u('AuthRule','ajax');?>",
		{
			id:id,
			type:'AuthRule_del',
		},
		function(result){
		//	console.log(result);
	        if(result===0){
	        	layer.msg('删除失败!',{icon: 5,time:1000});
	        }else if(result===2){
	        	layer.msg('此角色拥有下级角色，不能删除！',{icon: 5,time:3000});
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
			"<?php echo u('AuthRule','ajax');?>",
		{
			'sort':sortarr,
			'id':idarr,
			type:'AuthRule_sort',
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
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>