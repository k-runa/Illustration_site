<?php
	require_once('../includes/session_login.php');
	
	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');

	try {
		require_once ('../includes/db.php');

		$sql = 'SELECT code,picture,title FROM mst_illustration WHERE 1';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		$dbh = null;
	} catch (Exception $e) {
?>
		<main class="container">
			<div class="h1-group">
				<h1 class="h1-top">サーバー接続失敗</h1>
				<p class="h1-text h1-text-catch-e">ただいま障害により、<br>大変ご迷惑をお掛けしております。</p>
			</div>
		</main>
<?php	
		require_once ('../includes/footer_admin.php');
		exit();
	}
?>

<main class="container">
	<div class="h1-group">
		<h1 class="h1-disp">イラストデータ参照</h1>
		<p class="h1-text">どのイラストをくわしく見ますか？</p>
	</div>
	<div class="grid">
		<?php while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
			<div class="item">
				<a href="disp.php?code=<?php print $rec['code']; ?>">
					<img src="uploaded_pic/<?php print $rec['picture']; ?>">
				</a>
			</div>
		<?php } ?>
	</div>
</main>
<div class="btn-center">
	<a href="top.php" class="top-back-btn btn">トップページへ戻る</a>
</div>
<?php require_once('../includes/footer_admin.php'); ?>