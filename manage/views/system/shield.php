<?php if(!defined('UNI_V')){exit;}?>
<?php include dirname(__FILE__).'/../common/_meta.php'; ?>
<title>基本设置</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	基本设置
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<p><b>注意：</b>屏蔽词用英文竖线分隔   |  。</p>
	<form action="" method="post" >
	<div>
		<textarea name="shield" class="textarea" style="width:98%; height:300px; resize:none"><?php echo $this->data['shield']; ?></textarea>
	</div>
	<div class="mt-20 text-c">
		<button id="system-base-save" class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button>
	</div>
	</form>
</div>
<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
</body>
</html>