<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>系统配置列表 - 系统配置管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		系统管理
		<span class="c-gray en">&gt;</span>
		设置管理
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form action="" method="post">
				<input type="text" name="key" id="" placeholder="系统配置中文名称" style="width:450px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜配置</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="catesort()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 更新排序</a> 
				<a class="btn btn-primary radius" data-title="添加系统配置" _href="article-add.html" onclick="article_add('添加系统配置','<?php echo U('system','add'); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加系统配置</a>
				</span>
				<span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25">ID</th>
							<th >排序</th>
							<th width="70">中文名称</th>
							<th width="70">英文名称</th>
							<th width="100">配置类型</th>
							<th width="150">配置可选项</th>
							<th width="200">配置说明</th>
							<th width="80">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($this->data[0] as $k=>$v){ ?>
						<tr class="text-c">
							<td><?php echo $v['id']; ?></td>
							<td style="width: 30px;"><input type="text" name="<?php echo $v['id']; ?>" class="input-text lizhi" value="<?php echo $v['sort']; ?>"></td>
							<td class="text-l"><?php echo $v['cnname']; ?></td>
							<td class="text-l"><?php echo $v['enname']; ?></td>
							<td>
								<?php 
									if($v['type']== '1'){
										echo '单行文本';
									}elseif($v['type']== '2'){
										echo '多行文本';
									}elseif($v['type']== '3'){
										echo '单选框';
									}else{
										echo '未知';
									}
								?>
							</td>
							<td><?php echo $v['kxvalue']; ?></td>
							<td><?php echo $v['desc']; ?></td>
							<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('友情链接编辑','<?php echo u('system','edit',$v['id']); ?>','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
								<?php if($v['st']!= '1'){ ?>
								<a title="删除" href="javascript:;" onclick="article_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
								<?php } ?>
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

/*系统配置-添加*/
function article_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统配置-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统配置-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post(
			"<?php echo u('system','ajax');?>",
		{
			id:id,
			type:'system_del',
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
			"<?php echo u('system','ajax');?>",
		{
			'sort':sortarr,
			'id':idarr,
			type:'system_sort',
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