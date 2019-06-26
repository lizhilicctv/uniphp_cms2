<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>栏目添加</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<div class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-category-add">
		<input type="hidden"  value="<?php echo $this->data['id']; ?>" name="id">
		<div id="tab-category" class="HuiTab">
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">
						<span class="c-red">*</span>
						上级栏目：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="fid" name="fid">
							<option value="0">顶级分类</option>
							<?php foreach($this->datasort as $k=>$v){ ?>
							<option <?php if($v['id']==$this->data['fid']){ echo 'selected="selected"';} ?> value="<?php echo $v['id']; ?>"><?php echo str_repeat("|--",$v['level']).$v['catename'];?></option>
							<?php } ?>
						</select>
						</span>
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">
						<span class="c-red">*</span>
						栏目名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $this->data['catename']; ?>" placeholder="" id="catename" name="catename">
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">
						<span class="c-red">*</span>
						英文名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $this->data['en_name']; ?>" placeholder="" id="en_name" name="en_name">
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">栏目类型：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select name="type" id="type" class="select">
							<option <?php if($this->data['type'] == 1){ echo 'selected="selected"';} ?> value="1">文章列表</option>
							<option <?php if($this->data['type'] == 2){ echo 'selected="selected"';} ?> value="2">单页</option>
							<option <?php if($this->data['type'] == 3){ echo 'selected="selected"';} ?> value="3">图片列表</option>
						</select>
						</span>
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">
						栏目关键字：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $this->data['keyword']; ?>" placeholder="" id="keyword" name="keyword">
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">
						指定模版文件：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $this->data['template']; ?>" placeholder="" id="template" name="template"  style="width: 30%;">
						<span style="margin-left: 30px; color: #333333;">不指定，会调用默认模版</span>
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3 col-sm-2">栏目描述：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea name="mark" id="mark" cols="" rows="" class="textarea"  placeholder="说点什么，请输入..." onKeyUp="textlength()"><?php echo $this->data['mark']; ?></textarea>
						<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
					</div>
					<div class="col-3">
					</div>
				</div>
				
				<div class="row cl" id="yin" <?php if($this->data['type'] != 2){ echo "style='display: none;'";} ?> >
					<label class="form-label col-xs-3 col-sm-2">单页显示内容：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<script id="danye" type="text/plain" style="width:100%;height:400px;"><?php echo html_entity_decode($this->data['editorValue']); ?></script> 
					</div>
					<div class="col-3">
					</div>
				</div>
				
				<div class="row cl">
					<div class="col-9 col-offset-2">
						<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>

<!--请在下方写此页面业务相关的脚本-->
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
	
	$("#tab-category").Huitab({
		index:0
	});
	$("#form-category-add").validate({
		rules:{
			fid:{
				required:true,
			},
			catename:{
				required:true,
			},
		}
	});
	
	  
    $("#type").change(function () { 
        if (this.value== "2"){
        	 $('#yin').show();
        }
        else{
           $('#yin').hide();
        }
    })
	
var ue = UE.getEditor('danye');
});
function textlength(){
	var nmb=$('#mark').val().length;
	$('.textarea-length').text(nmb);
	if(nmb>100){
		$('#mark').css("background-color","orangered");
	}else{
		$('#mark').css("background-color","white");
	}
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>