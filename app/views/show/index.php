<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo getSession('system')["webname"]; ?></title>
		<meta name="keywords" content="<?php echo getSession('system')["keyword"]; ?>" />
		<meta name="description" content="<?php echo getSession('system')["miaoshu"]; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo APP_CONFIG['__index__']; ?>css/arc.css" rel="stylesheet">
	</head>
	<body>
		<?php include dirname(__FILE__).'/../common/_header.php'; ?>
		<div class="body">
			<div class="middle">
				<div class="body-l"> 
					<div class="body-l-shang">               <!--内容上边的广告图-->
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
							<h2><?php echo $this->data['title']; ?></h2>
							<p>来源：<?php echo $this->data['author']; ?> 发布时间：<?php echo date('Y-m-d',$this->data['up_time']); ?></p>
						</div>
					</div>
					<div class="clear"></div>
					<div class="body-l-zhongd">
						<p>
							摘要:<?php echo $this->data['desc']; ?>
						</p>
					</div>
					<div class="body-l-zhonge">
						<?php echo htmlspecialchars_decode($this->data['editor']); ?>
					</div>
					<div class="body-l-zhongf">
						<div class="body-l-zhongf-l">
							<p><a href="/">返回首页</a></p>
							<p><a href="/">Back Home</a></p>
						</div>
						<div class="body-l-zhongf-r">
							<img src="<?php echo APP_CONFIG['__index__']; ?>img/conwriter.png"/>
							<span>【责任编辑：<?php echo $this->data['author']; ?>】</span>
						</div>
					</div>
					<div class="clear"></div>
					<div class="body-l-zhongg">
						<p>上一篇：
						<?php if($this->shang){  ?>
								<a href="<?php echo u('show',$this->shang['id']); ?>"><?php echo $this->shang['title']; ?></a>
						<?php }else{ ?>
								第一页
						<?php } ?>
						</p>
						<p>下一篇：
							<?php if($this->xia){  ?>
									<a href="<?php echo u('show',$this->xia['id']); ?>"><?php echo $this->xia['title']; ?></a>
							<?php }else{ ?>
									最后一页
							<?php } ?>
						</p>
					</div>
					<div class="body-l-zhongh">
						<p>栏目精选</p>
					</div>
					<div class="body-l-zhongi1">
						<div class="body-l-zhongi-l">
							<ul>
								<?php foreach($this->shi as $k=>$v){ ?>
								<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 25 ); ?></a></li>
								<?php } ?>
							</ul>
						</div>
						<div class="body-l-zhongi-r">
							<?php foreach($this->er as $k=>$v){ ?>
								<a href="<?php echo u('show',$v['id']); ?>"><img src="<?php echo $v['pic']; ?>"/></a>
								<p><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 12); ?></a></p>
							<?php } ?>
						</div>
					</div>
					<div class="clear"></div>
					
					<div class="body-l-xia">                 <!--内容下边的广告图-->
						<a href="#"><img src="<?php echo APP_CONFIG['__index__']; ?>img/guanggao.png"/></a>
					</div>
				</div>
				
				<div class="body-r">
					<div class="body-ra">
						<ul>
							<?php foreach($this->si as $k=>$v){ ?>
								<li><a href="<?php echo u('show',$v['id']); ?>"><img src="<?php echo $v['pic']; ?>"/></a><p><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 8); ?></a></p></li>
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
							<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 25 ); ?></a></li>
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
