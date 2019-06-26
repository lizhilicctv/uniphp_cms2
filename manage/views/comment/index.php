<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>评论管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论中心 <span class="c-gray en">&gt;</span> 评论管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 
		<form action="" method="post">
			<input type="text" class="input-text" style="width:250px" placeholder="搜索内容" id="" name="key">
			<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜评论</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="data_del()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
	</span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="all" value=""></th>
				<th width="60">ID</th>
				<th width="100">用户名</th>
				<th width="300">评论内容</th>
				<th width="80">内容id</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->data[0] as $k=>$v){ ?>
			<tr class="text-c">
				<td><input type="checkbox" class="all" value="<?php echo $v['id']; ?>" name=""></td>
				<td><?php echo $v['id']; ?></td>
				<td><?php echo $v['username']; ?></td>
				<td><?php echo $v['content']; ?></td>
				<td><?php echo $v['article_id']; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['in_time']); ?></td>
				<td class="td-status">
					<?php
						switch ($v['isopen'])
						{
							case 1:
								echo "<span class='label label-success radius'>已展示</span>";
								break;
							case 0:
								echo "<span class='label label-default radius'>未展示</span>";
								break;
							default:
								echo "<span class='label label-danger radius'>未审核</span>";
						}
					?>
				</td>
				<td class="td-manage">
					<a title="编辑" href="javascript:;" onclick="comment_edit('编辑','<?php echo u('comment','edit',$v['id']) ?>','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a title="删除" href="javascript:;" onclick="comment_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
/*评论-编辑*/
function comment_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function comment_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('comment','ajax') ?>",
		{
			id:id,
			type:'comment_del',
		},
		function(result){
	        if(result[0]==1){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
	        	if(result[1]==0){
	        		parent.document.getElementById("lizhili_ping").innerHTML="评";
	        	}else{
	        		parent.document.getElementById("lizhili_ping").innerHTML="评"+result[1];
	        	}
	        }else{
	        	layer.msg('删除失败!',{icon: 5,time:1000});
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
				"<?php echo u('comment','ajax') ?>",
			{
				id:arr,
				type:'comment_all',
			},
			function(result){
				if(result==1){
					layer.msg('批量删除成功!',{icon:1,time:1000});
					if(result==0){
						parent.document.getElementById("lizhili_ping").innerHTML="评";
					}else{
						parent.document.getElementById("lizhili_ping").innerHTML="评"+result[1];
					}
					history.go(0);
				}else{
					layer.msg('删除失败!',{icon: 5,time:1000});
				}
		    });	
		});
   }
}
</script> 
</body>
</html>