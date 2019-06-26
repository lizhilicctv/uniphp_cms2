<div id="top">
	<div class="middle">
		<div class="l">
			<img src="<?php echo APP_CONFIG['__index__']; ?>img/xinlang.gif" />
			<a href="">新浪微博</a>
			<img src="<?php echo APP_CONFIG['__index__']; ?>img/rss.gif" />
			<a href="">网站地图</a>
			<img src="<?php echo APP_CONFIG['__index__']; ?>img/phone.gif" />
			<a href="">手机站</a>
		</div>
		<div class="r">
			<a href="">会员中心</a>|<a href="">帮助中心</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div id="logo">
	<div class="middle">
		<div class="l">
			<a href="/"><img src="<?php echo APP_CONFIG['__index__']; ?>img/logo.png" /></a>
		</div>
		<div class="l kuai2">
			<div>公益河北行，向世界传播中国公益声音！</div>
			<div>
				<iframe width="420" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="//i.tianqi.com/index.php?c=code&id=12&icon=1&py=shijiazhuang&num=5&site=12"></iframe>
			</div>
		</div>
		<div class="r" style="margin: 25px 25px 0 0;">
		<style type="text/css">
		#so360{white-space:nowrap}
		#so360 form{margin:0;padding:0}
		#so360_keyword{width:267px;height:37px;line-height:37px;font:14px arial;padding:
		2px 5px;margin-right:5px;border:2px solid #e60012;outline:0;vertical-align:middle}
		#so360_submit{width:70px;height:45px;border:0;color:#fff;
		 background:#e60012;font-weight:bold;font:bold 14px arial;padding:0;
		 padding-top:3px\9;cursor:pointer;
		vertical-align:middle}
		</style>
		<div id="so360">
			<form action="http://www.so.com/s" target="_blank" id="so360form">
		   <input type="text" autocomplete="off" name="q" id="so360_keyword">
				<input type="submit" id="so360_submit" value="搜 索">
				<input type="hidden" name="ie" value="utf8">
				<input type="hidden" name="src" value="zz_so.com">
				<input type="hidden" name="site" value="so.com">
				<input type="hidden" name="rg" value="1">
			</form>
		</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div id="nav">
	<div class="middle">

		<li><a href="/">首页</a></li>
		<?php foreach($this->nav as $k=>$v){ ?>
			<li><a target="_blank" href="<?php echo u('list',$v['id']); ?>"><?php echo $v['catename']; ?></a></li>
		<?php } ?>
	</div>
	<div class="clear"></div>
</div>

<div id="chengshi">
	<div class="middle">
		<p class="l">
			城市：
		</p>
		<ul class="l">
			<?php foreach($this->navtwo as $k=>$v){ ?>
				<li><a target="_blank" href="<?php echo u('list',$v['id']); ?>"><?php echo $v['catename']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="clear"></div>
</div>
