<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>留言管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 留言中心 <span class="c-gray en">&gt;</span> 留言管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 
	<form action="" method="post">
		<input type="text" class="input-text" style="width:250px" placeholder="搜索内容" id="" name="key">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜留言</button>
	</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> 
	</span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="60">ID</th>
				<th width="100">标题</th>
				<th width="60">姓名</th>
				<th width="60">手机</th>
				<th width="260">内容</th>
				<th width="130">时间</th>
				<th width="70">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->data[0] as $k=>$v){ ?>
			<tr class="text-c">
				<td><?php echo $v['id']; ?></td>
				<td><?php echo $v['title']; ?></td>
				<td><?php echo $v['name']; ?></td>
				<td><?php echo $v['phone']; ?></td>
				<td><?php echo $v['neirong']; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['in_time']); ?></td>
				<td class="td-status">
					<?php if($v['isopen'] == 1){ ?>
						<span class="label label-success radius">已查看</span>
					<?php }else{ ?>
						<span class="label label-default radius">未查看</span>
					<?php } ?>
				</td>
				<td class="td-manage">
					<a title="编辑" href="javascript:;" onclick="message_edit('编辑','<?php echo u('message','edit',$v['id']) ?>','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a title="删除" href="javascript:;" onclick="message_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
/*留言-编辑*/
function message_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function message_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post(
			"<?php echo u('message','ajax') ?>",
		{
			id:id,
			type:'message_del',
		},
		function(result){
			console.log(result)
			if(result[0]==1){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
				if(result[1]==0){
					parent.document.getElementById("lizhili_liu").innerHTML="留";
				}else{
					parent.document.getElementById("lizhili_liu").innerHTML="留"+result[1];
				}
			}else{
				layer.msg('删除失败!',{icon: 5,time:1000});
			}
	    });	
	});
}

</script> 
</body>
</html>