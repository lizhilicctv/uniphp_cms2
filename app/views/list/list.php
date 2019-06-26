<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo getSession('system')["webname"]; ?></title>
		<meta name="keywords" content="<?php echo getSession('system')["keyword"]; ?>" />
		<meta name="description" content="<?php echo getSession('system')["miaoshu"]; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo APP_CONFIG['__index__']; ?>css/list.css" rel="stylesheet">
	</head>
	<body>
		<?php include dirname(__FILE__).'/../common/_header.php'; ?>
		
		<div class="body">
			<div class="middle">
				<div class="body-l"> 
					<div class="body-l-shang">
						<a href="#"><img src="<?php echo APP_CONFIG['__index__']; ?>img/guanggao.png"/></a>
					</div>
					<div class="body-l-zhong">
						<div class="body-l-zhonga">
							<div class="body-l-zhonga-l">
								<img src="<?php echo APP_CONFIG['__index__']; ?>img/ico_location.gif"/>
								<a href="/">首页</a><span>></span>
								<a href="<?php echo u('list',$this->dao['id']); ?>"><?php echo $this->dao['catename']; ?></a><span>></span>
							</div>
							<div class="body-l-zhonga-r">
								<a href="/">返回首页</a>
							</div>
						</div>
						<div class="clear"></div>
						<div class="body-l-zhongb">
							<ul>
								<?php foreach($this->list[0] as $k=>$v){ ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo $v['title']; ?></a><p><?php echo date('Y-m-d',$v['up_time']); ?></p></li>
								<?php } ?>
							</ul>
						</div>
						<div class="xian"></div>
						<div class="clear"></div>
						<div class="body-l-zhongc">
							<?php echo $this->list[1]; ?>
						</div>
					</div>
					<div class="clear"></div>
					<div class="body-l-xia">
						<a href="#"><img src="<?php echo APP_CONFIG['__index__']; ?>img/guanggao.png"/></a>
					</div>
				</div>
				
				<div class="body-r">
					<div class="body-ra">
						<ul>
							<?php foreach($this->si as $k=>$v){ ?>
								<li><a href="<?php echo u('show',$v['id']); ?>"><img src="<?php echo $v['pic']; ?>"/></a><p><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 10 ); ?></a></p></li>
							<?php } ?>
							<div class="clear"></div>
						</ul>
					</div>
					<div class="clear"></div>
					<div style="margin: 10px;"></div>
					<div class="body-rc">
						<h4>最火资讯</h4>
						<ul class="body-rc2">
							<?php foreach($this->all as $k=>$v){ ?>
							<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 26); ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>				
			</div>
		</div>
		<div class="clear"></div>
		<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
	</body>
</html>
