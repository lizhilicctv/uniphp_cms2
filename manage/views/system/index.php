<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>基本设置</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="" method="post" class="form form-horizontal" id="form-article-add">
				
				<?php foreach($this->data as $k=>$v){ ?>
					<?php if($v['type'] == '1'){ ?>
						<div class="row cl">
							<label class="form-label col-xs-4 col-sm-2"><?php echo $v['cnname']; ?>：</label>
							<div class="formControls col-xs-8 col-sm-9">
								<input type="text" id="website-title" placeholder="" name="<?php echo $v['enname']; ?>" value="<?php echo $v['value']; ?>" class="input-text">
							</div>
						</div>
					<?php } ?>
					<?php if($v['type'] == '2'){ ?>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-2"><?php echo $v['cnname']; ?>：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<textarea name="<?php echo $v['enname']; ?>" class="textarea"><?php echo $v['value']; ?></textarea>
						</div>
					</div>
					<?php } ?>
					<?php if($v['type'] == '3'){ ?>
						<div class="row cl">
							<label class="form-label col-xs-4 col-sm-2"><?php echo $v['cnname']; ?>：</label>
							<div class="formControls col-xs-8 col-sm-9">
								<?php $lizhi=explode(",",$v['kxvalue']);
									foreach($lizhi as $k1=>$v1)
									{
								?>   	
									<div class="radio-box" style="margin-top: 3px;padding-left: 0;">
									     <input type="radio" id="radio-1" name="value" <?php if($v1 == $v['value']){ echo 'checked';}?> value="<?php echo $v1 ?>">
									    <label for="radio-1"><?php echo $v1 ?></label>
									</div>
								<?php	}	?>
								
							</div>
						</div>
					<?php } ?>
					
				<?php } ?>
				
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
						<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
					</div>
				</div>
			</form>
		</article>
	</div>


<!--_footer 作为公共模版分离出去--> 
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--/_footer /作为公共模版分离出去--> 

<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>