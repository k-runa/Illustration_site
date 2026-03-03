<?php
	require_once('../includes/sanitize.php');

	$post = sanitize($_POST);
	$staff_code = $post['code'];
	$staff_pass = $post['pass'];

	$staff_pass = md5($staff_pass);

	try {
		require_once('../includes/db.php');

		$sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
		$stmt = $dbh->prepare($sql);

		$data = array();

		$data[] = $staff_code;
		$data[] = $staff_pass;
		$stmt->execute($data);

		$dbh = null;

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($rec === false) {
			session_start();
			header('Location: login_error.php');
			exit();

		} else {
			session_start();
			$_SESSION['login'] = 1;
			$_SESSION['staff_code'] = $staff_code;
			$_SESSION['staff_name'] = $rec['name'];

			header('Location:top.php');
			exit();
		}
	} catch (Exception $e) {
		require_once('../includes/head_admin.php');
?>
	<header>
		<p class="header-title">
			ゆるめらくがき記録 <br>管理者専用サイト
		</p>
	</header>
	<main class="container">
		<div class="h1-group">
			<h1 class="h1-top">サーバー接続失敗</h1>
			<p class="h1-text h1-text-catch-e">ただいま障害により、<br>大変ご迷惑をお掛けしております。</p>
		</div>
	</main>
<?php
		require_once('../includes/footer_admin.php');
	exit();
	}
	
?>