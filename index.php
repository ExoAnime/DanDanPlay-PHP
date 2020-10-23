<?php include_once 'function.php';
if($authorization and !checkUserAndPasswordFromCookie($_COOKIE["Username"], $_COOKIE["Auth"])) {
	sendStatusCode(303, 'See Other', './login.php', 0);
} 
if(!$authorization){
	setcookie("Username",'',time()-1);
	setcookie("Auth",'', time()-1);
}
?>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="css/icon.png" type="image/x-icon">
	<title><?php include_once 'function.php';echo ($site_name); ?></title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="./js/function.js"></script>
	<style>
		body {
			background-image: url(./src/background.png);
			background-attachment: fixed;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		.video-text {
			line-height: 1.3;
		}

		.line-limit-length {
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}

		.nobords {
			margin: 0;
			padding: 0;
		}

		.li {
			position: sticky;
			top: 0;
		}

		.transform {
			background-color: rgba(255, 255, 255, 0.8);
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#"><?php include_once 'function.php';echo ($site_name); ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="./">首页</a>
					</li>
					<?php include_once 'function.php';if($_COOKIE["Username"]!=''){echo('<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$_COOKIE["Username"].'</a><div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"><a class="dropdown-item" href="./login.php?logout=true">注销登录</a></div></li>');} ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php include_once 'function.php';echo ($About_link); ?>" target="_blank">关于</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://github.com/CberYellowstone/DanDanPlay-PHP" target="_blank">Bug反馈</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://github.com/kaedei/dandanplay-libraryindex" target="_blank">帮助改进此页面</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" id="qrcode" onclick="switchqrcode();">远程访问</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0" method="POST" action="./">
					<input class="form-control mr-sm-2" type="text" name="q" placeholder="在这里搜索哦ο(=•ω＜=)ρ⌒☆..." data-form-field="seach" required="" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
				</form>
			</div>
		</div>
	</nav>

	<img src='<?php include_once 'function.php'; echo('https://wenhairu.com/static/api/qr/?size=300&text={"about":"请使用支持弹弹play远程访问功能的客户端扫描此二维码","ip":["'.$remote_addres.'"],"port":'.$remote_port.',"machineName":"'.urljsonDecode($site_name).'","currentUser":"'.urljsonDecode($user_name).'","tokenRequired":false}');?>' id="qrcode_img" style='display:none;margin-left:auto;margin-right:auto;' width="300px" hight="300px">


	<div class="clearfix row nobords">
		<div class="col-md-3 col-xs-12 float-left nobords">
			<div class="list-group  li">
				<a href="" class="list-group-item list-group-item-action active rounded-0 line-limit-length">作品列表</a>
				<?php include_once 'function.php';listRoot($video_root_path,TRUE,$_GET['animeName']);?>
				<a href="./" class="list-group-item list-group-item-action active rounded-0 line-limit-length">返回首页</a>
			</div>
		</div>
		<div class=" col-md-9 col-xs-12 float-left transform">
		<?php include_once 'function.php';mkCardForRoot($video_root_path,$_GET['animeName'],$_POST['q']);?>
			<div class="col-12 float-right text-center pt-5">
				<p><?php include_once 'function.php';echo ($site_name."由 弹弹play 提供部分支持.</br>");echoServerInformation()?></p>
				<p></p>
			</div>
		</div>
	</div>

	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>