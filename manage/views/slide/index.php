<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>幻灯片管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 幻灯片管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
		<div class="pd-20 text-c">
			<div class="text-c">
				<form action="" method="post">
					<input type="text" name="key" id="" placeholder="幻灯片名称" style="width:250px" class="input-text">
					<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="catesort()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 更新排序</a> <a class="btn btn-primary radius" onclick="system_category_add('添加幻灯片','<?php echo u('slide','add'); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加幻灯片</a></span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-hover table-bg table-sort">
					<thead>
						<tr class="text-c">
							<th width="10">ID</th>
							<th width="10">排序</th>
							<th width="30%">图片</th>
							<th width="25%">链接地址</th>
							<th width="25%">图片标题</th>
							<th width="10">图片状态</th>
							<th width="10">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($this->data[0] as $k=>$v){ ?>
						<tr class="text-c">
							<td><?php echo $v['id']; ?></td>
							<td style="width: 15px;"><input type="text" name="<?php echo $v['id']; ?>" class="input-text lizhi"  value="<?php echo $v['sort']; ?>"></td>
							<td><img src="<?php echo $v['img']; ?>" height="60"/></td>
							<td><a href="<?php echo $v['url']; ?>" target="_blank"><?php echo $v['url']; ?></a></td>
							<td><?php echo $v['title']; ?></td>
							<td>
								<?php if($v['isopen'] == 1){?>
									<span class="label label-success radius">已启用</span>
								<?php }else{ ?>
									<span class="label label-default radius">已禁用</span>
								<?php } ?>
							</td>
							<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('幻灯片编辑','<?php echo u('slide','edit',$v['id']); ?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="system_category_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				
			</div>
			<?php echo $this->data[1]; ?>
		</div>
<!--_footer 作为公共模版分离出去-->
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__MANAGE__lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__MANAGE__lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="__MANAGE__lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*系统-幻灯片-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-幻灯片-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-幻灯片-删除*/
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post(
			"<?php echo u('slide','ajax');?>",
		{
			id:id,
			type:'slide_del',
		},
		function(result){
	        if(result===0){
	        	layer.msg('删除失败!',{icon: 5,time:1000});
	        }else if(result===1){
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
			"<?php echo u('slide','ajax');?>",
		{
			'sort':sortarr,
			'id':idarr,
			type:'slide_sort',
		},
		function(result){
			console.log(result);
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