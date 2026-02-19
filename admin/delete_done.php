<?php
	require_once('../includes/session_login.php');

	$pic_code = $_POST['code'];
	$pic_picture = $_POST['picture'];
	
	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');

try {	
	require_once('../includes/db.php');

	$sql = 'DELETE FROM mst_illustration WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $pic_code;
	$stmt->execute($data);

	$dbh = null;

	unlink('uploaded_pic/'.$pic_picture);

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
			<h1 class="h1-delete">イラストデータ削除</h1>
			<p class="h1-text">削除が完了しました！</p>
			<div class="align-center">
				<img src="../images/done.gif" class="gif">
			</div>		
		</div>
</main>
<div class="btn-center">
	<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
	<a href="delete_select.php" class="one-back-btn btn">選択画面へ<br>戻る</a>
</div>	

<?php
	require_once('../includes/footer_admin.php'); ?>
?>