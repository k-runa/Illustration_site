<?php
	session_start();
	$_SESSION = array();
	
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000,'/');
	}
	session_destroy();

	require_once('../includes/head_admin.php');
?>
<header>
	<p class="header-title"><span>ゆるめらくがき記録 </span><span class="title-br">管理者専用サイト</span></p>
</header>

<main class="container">
	<div class="h1-group">
		<h1 class="h1-top">ログアウト</h1>
		<p class="h1-text">ログアウトが完了しました！</p>
		<div>
			<img src="../images/done.gif" class="gif">
		</div>
	</div>
	<div class="btn-center">
		<a href="login.php" class="submit-btn btn">ログイン画面へ</a>	
	</div>
</main>

<?php require_once('../includes/footer_admin.php'); ?>