<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>管理员列表</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 栏目管理 <span class="c-gray en">&gt;</span> 栏目列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 
		<form action="" method="post">
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="key">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
		</form>
	</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="catesort()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 更新排序</a> <a class="btn btn-primary radius" onclick="system_category_add('添加栏目','<?php echo u('cate','add'); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a></span> <span class="r">共有数据：<strong><?php echo $this->count; ?></strong> 条</span> </div>
			<div>
				<table class="table table-border table-bordered table-hover table-bg table-sort">
					<thead>
						<tr class="text-c">
							<th width="25">ID</th>
							<th >排序</th>
							<th width="60">栏目名称</th>
							<th width="60">英文名称</th>
							<th width="60">栏目类型</th>
							<th width="80">栏目关键字</th>
							<th width="80">模版文件</th>
							<th width="110">栏目备注</th>
							<th width="60">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($this->datasort as $k=>$v){ ?>
						<tr class="text-c">
							<td><?php echo $v['id']; ?></td>
							<td style="width: 30px;"><input type="text" name="<?php echo $v['id']; ?>" class="input-text lizhi" value="<?php echo $v['sort']; ?>"></td>
							<td class="text-l">
								<?php if(isset($v['level'])){echo str_repeat("|--",$v['level']);}?><?php echo $v['catename']; ?>
							</td>
							<td>
								<?php echo $v['en_name']; ?>
							</td>
							<td>
								<?php
									switch ($v['type'])
									{
									case 1:
										echo '文章列表';
										break;
									case 2:
										echo '单页';
										break;
									default:
										echo '图文';
									}
								?>
							</td>
							<td><?php echo $v['keyword']; ?></td>
							<td><?php echo $v['template'] ?? '没有指定文件'; ?></td>
							<td><?php echo $v['mark']; ?></td>
							<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','<?php echo u('cate','edit',$v['id']) ?>','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="system_category_del(this,<?php echo $v['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
<!--_footer 作为公共模版分离出去-->
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,1200,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,1200,800);
}
/*系统-栏目-删除*/
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post(
			"<?php echo u('cate','ajax') ?>",
		{
			id:id,
			type:'cate_del',
		},
		
		function(result){
			console.log(result);
	        if(result==0){
	        	layer.msg('删除失败!',{icon: 5,time:1000});
	        }else if(result==2){
	        	layer.msg('此栏目拥有下级栏目，不能删除！',{icon: 5,time:3000});
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
			"<?php echo u('cate','ajax') ?>",
		{
			'sort':sortarr,
			'id':idarr,
			type:'cate_sort',
		},
		function(result){
			//console.log(result);
	        if(result==1){
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





