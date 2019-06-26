<?php use UNI\tools\Db;?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo getSession('system')["webname"]; ?></title>
		<meta name="keywords" content="<?php echo getSession('system')["keyword"]; ?>" />
		<meta name="description" content="<?php echo getSession('system')["miaoshu"]; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo APP_CONFIG['__index__']; ?>css/index.css" rel="stylesheet">
		<script crossorigin="anonymous" integrity="sha384-rY/jv8mMhqDabXSo+UCggqKtdmBfd3qC2/KvyTDNQ6PcUJXaxK1tMepoQda4g5vB" src="https://lib.baomitu.com/jquery/2.2.4/jquery.min.js"></script>
		<script src="<?php echo APP_CONFIG['__index__']; ?>js/jquery.SuperSlide.2.1.3.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<?php include dirname(__FILE__).'/../common/_header.php'; ?>
		<div class="body1">
			<div class="middle">
				<div class="gg">
					<img src="<?php echo APP_CONFIG['__index__']; ?>img/banner1.jpg"/>
				</div>
				<div class="kuai1">
					<h2><a href="<?php echo u('show',$this->one['id']); ?>"><?php echo mb_substr( $this->one['title'], 0, 26); ?></a></h2>
					<ul>
						<?php foreach($this->three as $k=>$v){ ?>
						<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 16); ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="kuai2-l">
					<div class="kuai2-l-s">
						
						<style type="text/css">


							/* 本例子css */
							.slideBox{ width:380px; height:316px; overflow:hidden; position:relative; border:1px solid #ddd;  }
							.slideBox .hd{ height:15px; overflow:hidden; position:absolute; right:5px; bottom:5px; z-index:1; }
							.slideBox .hd ul{ overflow:hidden; zoom:1; float:left;  }
							.slideBox .hd ul li{ float:left; margin-right:2px;  width:15px; height:15px; line-height:14px; text-align:center; background:#fff; cursor:pointer; }
							.slideBox .hd ul li.on{ background:#f00; color:#fff; }
							.slideBox .bd{ position:relative; height:100%; z-index:0;   }
							.slideBox .bd li{ zoom:1; vertical-align:middle; }
							.slideBox .bd img{ width:380px; height:316px; display:block;  }

							/* 下面是前/后按钮代码，如果不需要删除即可 */
							.slideBox .prev,
							.slideBox .next{ position:absolute; left:3%; top:50%; margin-top:-25px; display:block; width:32px; height:40px; background:url(images/slider-arrow.png) -110px 5px no-repeat; filter:alpha(opacity=50);opacity:0.5;   }
							.slideBox .next{ left:auto; right:3%; background-position:8px 5px; }
							.slideBox .prev:hover,
							.slideBox .next:hover{ filter:alpha(opacity=100);opacity:1;  }
							.slideBox .prevStop{ display:none;  }
							.slideBox .nextStop{ display:none;  }

							</style>

							<div id="slideBox" class="slideBox">
								<div class="hd">
									<ul><li>1</li><li>2</li><li>3</li></ul>
								</div>
								<div class="bd">
									<ul>
										<?php
										 $zixun= Db::name('article')->where("pic <> ''", 1)->limit(3)->getall('id,title,pic');
										 foreach($zixun as $k=>$v){
										 ?>
										<li><a href="<?php echo u('show',$v['id']); ?>" target="_blank"><img src="<?php echo $v['pic']; ?>" /></a></li>
										<?php } ?>
									</ul>
								</div>

								<!-- 下面是前/后按钮代码，如果不需要删除即可 -->
								<a class="prev" href="javascript:void(0)"></a>
								<a class="next" href="javascript:void(0)"></a>

							</div>

							<script type="text/javascript">
							jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
							</script>

						
						
						
						
						
					</div>
					<div class="kuai2-l-x">
						<h4>资讯</h4>
						<ul>
							<?php
							 $zixun= Db::name('article')->where("cateid = ?", 1)->limit(9)->getall('id,title,pic');
							 foreach($zixun as $k=>$v){
							 ?>
							<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 26); ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="kuai2-m">
					<h2>国内新闻</h2>
					
					<?php
					 $guonei= Db::name('article')->where("cateid = ?", 2)->limit(2)->getall("id,title,pic,desc");
					 foreach($guonei as $k=>$v){
					 ?>
					<p><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 26); ?></a></p>
					<span>
						<?php echo mb_substr( $v['desc'], 0, 56); ?>
					</span>
					<?php } ?>

					<ul>
						<?php
						 $guonei= Db::name('article')->where("cateid = ?", 3)->limit(10)->getall("id,title,pic,desc");
						 foreach($guonei as $k=>$v){
						 ?>
						<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 26); ?></a></li>
						<?php } ?>
						
					</ul>				  
				</div>
				<div class="kuai2-r">
					<div class="kuai2-r-s">
						<a href="#"><img src="<?php echo APP_CONFIG['__index__']; ?>img/ad.jpg" alt="广告"/></a>
					</div>					
					<ul class="kuai2-r-x">
						<li><h4>学校人物</h4></li>
						<?php
						 $guonei= Db::name('article')->where("cateid = ?", 4)->limit(9)->getall("id,title,pic,desc");
						 foreach($guonei as $k=>$v){
						 ?>
						<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
						<?php } ?>
					</ul>											
				</div>
				<div class="clear"></div>
				<div class="gg"> <!--“百佳公益组织”评选活动申报入口 -->
					<img src="<?php echo APP_CONFIG['__index__']; ?>img/banner2.jpg"/>
				</div>
				<ul class="kuai3">
					
					<?php
					 $guonei= Db::name('article')->where("cateid = ? and pic <> ''", 5)->limit(9)->getall("id,title,pic,desc");
					 foreach($guonei as $k=>$v){
					 ?>
					<li>
						<p><a href="<?php echo u('show',$v['id']); ?>"><img src="<?php echo $v['pic']; ?>"/></a></p>
						<h4><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></h4>
						<p> <?php echo mb_substr( $v['title'], 0, 21); ?>...<a href="<?php echo u('show',$v['id']); ?>">[阅读]</a></p>							
					</li>
					<?php } ?>
					
				</ul>
				<div class="clear"></div>	
				<ul class="gongyong">
					<li>
						<div>
							<span>典型</span>
							<?php
							$fu=Db::name('cate')->where('id = ?',6)->get('id,catename');
							 ?>
							<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
						</div>
						<?php
							$tu=Db::name('article')->where("cateid = ? and pic <> ''", 6)->get();
						 ?>
						<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
						<ul>
							<?php
							 $guonei= Db::name('article')->where("cateid = ?", 6)->limit(5)->getall("id,title,pic,desc");
							 foreach($guonei as $k=>$v){
							 ?>
							<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
							<?php } ?>
						</ul>						
					</li>
					<li>
						<div>
							<span>益人</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',7)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 7)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 7)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>好人</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',8)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 8)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 8)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>好事</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',9)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 9)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 9)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>评选</span>
						<?php
								$fu=Db::name('cate')->where('id = ?',10)->get('id,catename');
								 ?>
								<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
							</div>
							<?php
								$tu=Db::name('article')->where("cateid = ? and pic <> ''", 10)->get();
							 ?>
							<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
							<ul>
								<?php
								 $guonei= Db::name('article')->where("cateid = ?",10)->limit(5)->getall("id,title,pic,desc");
								 foreach($guonei as $k=>$v){
								 ?>
								<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
								<?php } ?>
							</ul>						
						</li>
					<li>
						<div>
							<span>综合</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',11)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 11)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 11)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<div class="clear"></div>	
				</ul>			
							
				
				<ul class="gongyong">
					<li>
						<div>
							<span>突发</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',12)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 12)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 12)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>					
					</li>
					<li>
						<div>
							<span>动保</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',13)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 13)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?",13)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>名录</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',14)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 14)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 14)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>环保</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',15)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 15)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 15)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>慈善企业</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',16)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 16)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 16)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>服务</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',17)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 17)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 17)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<div class="clear"></div>
				</ul>
				
				<div class="gg"> <!--“百佳公益组织”评选活动申报入口 -->
					
					<img src="<?php echo APP_CONFIG['__index__']; ?>img/banner3.jpg"/>
				</div>
				<ul class="gongyong">
					<li>
						<div>
							<span>公开</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',18)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 18)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 18)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>寻人</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',19)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 19)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 19)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>招募</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',20)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 20)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 20)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>求助</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',21)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 21)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 21)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>学习</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',22)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 22)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 22)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<li>
						<div>
							<span>评论</span>
							<?php
									$fu=Db::name('cate')->where('id = ?',23)->get('id,catename');
									 ?>
									<a href="<?php echo u('show',$fu['id']); ?>">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/more.gif"/></a>						
								</div>
								<?php
									$tu=Db::name('article')->where("cateid = ? and pic <> ''", 23)->get();
								 ?>
								<p><a href="<?php echo u('show',$tu['id']); ?>"><img src="<?php echo $tu['pic']; ?>"/></a></p>
								<ul>
									<?php
									 $guonei= Db::name('article')->where("cateid = ?", 23)->limit(5)->getall("id,title,pic,desc");
									 foreach($guonei as $k=>$v){
									 ?>
									<li><a href="<?php echo u('show',$v['id']); ?>"><?php echo mb_substr( $v['title'], 0, 21); ?></a></li>
									<?php } ?>
								</ul>						
							</li>
					<div class="clear"></div>
				</ul>			
				
			    <div class="gg"> <!--“百佳公益组织”评选活动申报入口 -->
					<img src="<?php echo APP_CONFIG['__index__']; ?>img/banner4.jpg"/>
				</div>
				<div class="kuai5">
					<p>
						<span>分享</span>
						<a href="#">更多<img src="<?php echo APP_CONFIG['__index__']; ?>img/sanjiao.png" ></a>
					</p>
					<ul>
						<?php
						 $guonei= Db::name('article')->where("cateid = ? and pic <> ''", 24)->limit(6)->getall("id,title,pic,desc");
						 foreach($guonei as $k=>$v){
						 ?>
						<li><a href="<?php echo u('show',$v['id']); ?>"><img width="300" src="<?php echo $v['pic']; ?>"/></a></li>
						<?php } ?>
					</ul>					
				</div>
				<div class="clear"></div>
				<div class="gg"> <!--“百佳公益组织”评选活动申报入口 -->
					<img src="<?php echo APP_CONFIG['__index__']; ?>img/banner5.jpg"/>
				</div>
				<div class="kuai6">
					<ul>
						<li>														
							<dt>友情链接</dt>
							<div>
								<?php
								 $guonei= Db::name('link')->getall("title,linkurl");
								 foreach($guonei as $k=>$v){
								 ?>
								<dd><a href="<?php echo $v['linkurl'] ?>"><?php echo $v['title'] ?></a></dd>
								<?php } ?>
							    
							    
		                    </div>				   
						</li>
					</ul>	
					<div class="clear">	</div>
				</div>
			</div>
		</div>
		<?php include dirname(__FILE__).'/../common/_footer.php'; ?>
	</body> 
</html>
