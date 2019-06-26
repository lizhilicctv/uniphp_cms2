<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>资讯列表 - 资讯管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		资讯管理
		<span class="c-gray en">&gt;</span>
		资讯列表
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form action="" method="post">
				<input type="text" class="input-text" style="width:250px" placeholder="资讯名称" id="" name="key">
				<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="data_del()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				<a class="btn btn-primary radius" data-title="添加资讯" _href="article-add.html" onclick="article_add('添加资讯','<?php echo u('article','add'); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a>
				</span>
				<span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="40">ID</th>
							<th width="120">标题</th>
							<th width="60">分类</th>
							<th width="40">作者</th>
							<th width="80">缩率图</th>
							<th width="280">简介</th>
							<th width="120">发布时间</th>
							<th width="50">浏览次数</th>
							<th width="50">推荐状态</th>
							<th width="70">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->data[0] as $k=>$v){ ?>
						<tr class="text-c">
							<td><input type="checkbox" class="all" value="<?php echo $v['id']; ?>" name=""></td>
							<td><?php echo $v['id'] ?></td>
							<td class="text-l"><a href=""><?php echo $v['title']; ?></a></td>
							<td><?php echo $v['catename']; ?></td>
							<td><?php echo $v['author']; ?></td>
							<td>
								<?php if($v['pic'] == ''){ ?>
									暂无缩率图
								<?php }else{ ?>
									<img src="<?php echo $v['pic']; ?>" height="50"/>
								<?php } ?>
							</td>
							<td><?php echo $v['desc']; ?></td>
							<td><?php echo date('Y-m-d H:i:s',$v['up_time']); ?></td>
							<td><?php echo $v['click']; ?></td>
							<td class="td-status">
								<?php if($v['state'] == 0){ ?>
									<span class="label label-disabled radius">不推荐</span>
								<?php }else{ ?>
									<span class="label label-success radius">推荐</span>
								<?php } ?>
							</td>
							<td class="f-14 td-manage">
								<a style="text-decoration:none" class="ml-5" onclick="article_add('修改资讯','<?php echo u('article','edit',$v['id']); ?>')"  href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,<?php echo $v['id']; ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
							
							</td>
						</tr>
					<?php } ?>

					</tbody>
				</table>
				<?php echo $this->data[1]; ?>
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

/*资讯-添加*/
function article_add(title,url,w,h){
	layer_show(title,url,1200,h);
}
// function article_add(title,url,w,h){
// 	var index = layer.open({
// 		type: 2,
// 		title: title,
// 		content: url
// 	});
// 	layer.full(index);
// }
/*资讯-编辑*/
function article_edit(title,url,w,h){
	layer_show(title,url,1200,h);
}
// function article_edit(title,url,id,w,h){
// 	var index = layer.open({
// 		type: 2,
// 		title: title,
// 		content: url
// 	});
// 	layer.full(index);
// }
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post(
			"<?php echo u('article','ajax');?>",
		{
			id:id,
			type:'article_del',
		},
		function(result){
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
    alert("请至少选择一个");
   }else{
	   	layer.confirm('确认要删除吗？',function(index){
			$.post(
				"<?php echo u('article','ajax');?>",
			{
				id:arr,
				type:'article_all',
			},
			function(result){
		        if(result===0){
		        	layer.msg('批量删除失败!',{icon: 5,time:1000});
		        }else{
					layer.msg('批量删除成功!',{icon:1,time:1000});
					history.go(0);
					//window.location.href='/manage.php/admin/index.html';
		        }
		    });	
		});
   }
	
}
/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>