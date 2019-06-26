<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>

<title>新增文章 - 资讯管理</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>

<article class="page-container" style="padding-left: 100px !important;">
	<form class="form form-horizontal" enctype="multipart/form-data"  action="" method="post" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-9 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请输入文章标题" id="title" name="title">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-9 col-sm-9"> <span class="select-box">
				<select  name="cateid" class="select">
					<option value>全部栏目</option>
					<?php foreach($this->datasort as $k=>$v){ ?>
						<option value="<?php echo $v['id']; ?>"><?php if(isset($v['level'])){echo str_repeat("|--",$v['level']);} echo $v['catename']; ?></option>
					<?php } ?>
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2">关键词：</label>
			<div class="formControls col-xs-9 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请输入关键词" id="keyword" name="keyword">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2">文章摘要：</label>
			<div class="formControls col-xs-9 col-sm-9">
				<textarea name="desc" cols="" rows="" id="desc" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textlength()"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2">文章作者：</label>
			<div class="formControls col-xs-9 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="author" name="author">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2">设为推荐：</label>
			<div class="formControls col-xs-9 col-sm-9">
				<div class="switch"  data-on-label="开" data-off-label="关">
			      <input type="checkbox" name="state"/>
			    </div>
			</div>
		</div>
		 
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2">缩略图：</label>
			<div class="formControls col-xs-9 col-sm-9">
				<div class="uploader-thum-container">
					<a href="javascript:void();"  class="btn btn-primary radius"><i class="icon Hui-iconfont">&#xe642;</i> 浏览文件</a>
					<input type="file" class="input-file" onchange='onpic()' name="pic" id="pic" value="" accept='image/*' style="font-size: 20px;left:0;"/><span id="sp"></span>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-3 col-sm-2"><span class="c-red">*</span>文章内容：</label>
			<div class="formControls col-xs-9 col-sm-9"> 
				<script id="editor" name='editor' type="text/plain" style="width:100%;height:400px;"></script> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>&nbsp;&nbsp;提交</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<style type="text/css">
	.li123{
		line-height: 30px;
		background: burlywood;
		display: inline-block;
		vertical-align: middle;padding: 0 8px;
	}
</style>
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/jquery.validation/1.14.0/messages_zh.js"></script>   
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="<?php echo APP_CONFIG['__manage__']; ?>lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-article-add").validate({
		rules:{
			title:{
				required:true,
			},
			cateid:{
				required:true,
			},
			editor:{
				required:true,
			},
		}
	});
	
	
	var ue = UE.getEditor('editor');
	
});

function removeIframe(){
	history.go(-1);
	return false;
}
function textlength(){
	var nmb=$('#desc').val().length;
	$('.textarea-length').text(nmb);
	if(nmb>200){
		$('#desc').css("background-color","orangered");
	}else{
		$('#desc').css("background-color","white");
	}
}
function onpic(){
	var file=document.getElementById("pic").files[0];
	document.getElementById("sp").innerHTML='您已经选择图片：'+file['name'];
	document.getElementById("sp").className = 'li123';
}
</script>

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>