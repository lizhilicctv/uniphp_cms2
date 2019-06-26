<?php if(!defined('UNI_V')){exit;}?>
<?php 
include dirname(__FILE__).'/../common/_meta.php';
?>
<title>我的桌面</title>
<meta name="keywords" content="uniphp">
<meta name="description" content="uniphp,轻量级php框架.">
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎使用<b>后台管理系统</b> <span class="f-14">v1.0</span>！</p>
	<p>登录次数：<?php echo $this->count; ?> </p>
	<p>本次登录IP：<?php echo $this->log['ip']; ?>  本次登录时间：<?php echo date('Y-m-d H:i:s',$this->log['in_time']); ?></p>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>
				<th>留言库</th>
				<th>会员</th>
				<th>评论库</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td><?php echo $this->w['zong']; ?></td>
				<td><?php echo $this->liu['zong']; ?></td>
				<td><?php echo $this->yong['zong']; ?></td>
				<td><?php echo $this->ping['zong']; ?></td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td><?php echo $this->w['jin']; ?></td>
				<td><?php echo $this->liu['jin']; ?></td>
				<td><?php echo $this->yong['jin']; ?></td>
				<td><?php echo $this->ping['jin']; ?></td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td><?php echo $this->w['zuo']; ?></td>
				<td><?php echo $this->liu['zuo']; ?></td>
				<td><?php echo $this->yong['zuo']; ?></td>
				<td><?php echo $this->ping['zuo']; ?></td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td><?php echo $this->w['zhou']; ?></td>
				<td><?php echo $this->liu['zhou']; ?></td>
				<td><?php echo $this->yong['zhou']; ?></td>
				<td><?php echo $this->ping['zhou']; ?></td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td><?php echo $this->w['yue']; ?></td>
				<td><?php echo $this->liu['yue']; ?></td>
				<td><?php echo $this->yong['yue']; ?></td>
				<td><?php echo $this->ping['yue']; ?></td>
			</tr>
		</tbody>
	</table>
	<table class="table table-border table-bordered table-bg mt-20">
		
		<div id="bang">
			<h2>使用说明</h2>
			<p style="text-indent: 20px;">感谢您一年来对我们的支持和包容。为了更好的服务大家，在2018年9月份，我们全新发布了后台管理系统版本。我们的发布离不开广大用户给出的建议和意见。我们整合了更多优秀插件；优化了框架的体积。当然相比目前行业其他管理系统还有很多不足。但初心不改，实实在在把事做好，做用户最喜欢的框架。更好为客户服务。</p>
			<p style="text-indent: 20px;">2018年我们进行了五个大版本的更新，添加了商城，论坛，订货等等系统。2019年六月我们从新开始用自己编写的框架，重新搭建了cms，速度提升了10倍。希望我们的cms可以给您带来帮助。由于工作量大，难免有没有考虑的地方。欢迎您反馈！</p>
			<p class="red">注：扫描二维码，可以添加解决疑问专家的QQ/微信，添加好友时请您写明疑问，以便解决您的问题</p>
			<div class="fen">
				<span>疑问QQ群：99078439</span>
				<a href="mailto:lizhilimaster@163.com">发送邮件：lizhilimaster@163.com</a>
				<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=d0eb332edc6d7702e82852e29fd39e065ee75aa4f828adc992b931b9817f2254"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="河北网站技术交流" title="河北网站技术交流"></a>
				<img  style="CURSOR: pointer" onclick="javascript:window.open('tencent://message/?uin=821642832&Site=www.linglukeji.com&Menu=yes', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:821642832:1 alt="点击这里给我发消息">
			</div>
			<div class="frame-img"> <img src="/static/manage/qqimg.jpg" width="130" ><img src="/static/manage/weixinimg.jpg" width="130"><img src="/static/manage/qqqun.jpg" width="130"></div>
		</div>
		
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢hui0、jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch提供技术支持<br>
			Copyright &copy;2015-2018 李志立 All Rights Reserved.<br>
			本后台系统由<a href="mailto:lizhilimaster@163.com" target="_blank" title="lizhili">李志立</a>提供技术支持</p>
	</div>
</footer>
<?php 
include dirname(__FILE__).'/../common/_footer.php';
?>

</body>
</html>