<?php
	require_once('../includes/session_login.php');
	
	$pic_code = $_GET['code'];
	
	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');
	
	try {
		require_once ('../includes/db.php');

		$sql = 'SELECT picture, title, date, comment FROM mst_illustration WHERE code=?';
		$stmt = $dbh->prepare($sql);
		$data[] = $pic_code;
		$stmt->execute($data);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$pic_picture = $rec['picture'];
		$pic_title = $rec['title'];
		$pic_date = $rec['date'];
		$pic_comment = $rec['comment'];

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

<main class="detail-container">

	<div class="h1-group">
		<h1 class="h1-delete">イラストデータ削除</h1>
		<p class="h1-text">本当に削除しますか？</p>
	</div>

		<div class="detail">

			<div class="disp-pic">
				<img src="uploaded_pic/<?php print $pic_picture; ?>">
			</div>

			<div class="disp-text">
				<div class="disp-text-group">
					<p class="disp-title">タイトル：</p>
					<p class="disp-content"><?php print $pic_title; ?></p>
				</div>
				<div class="disp-text-group">
					<p class="disp-title">制作日：</p>
					<p class="disp-content">
						<?php 
							if ($pic_date === '0001-01-01') {
								print '不明';
							} else {
								print $pic_date;
							}
						?>
					</p>
				</div>
				<div class="disp-text-group">
					<p class="disp-title">コメント：</p>
					<p class="disp-content"><?php print $pic_comment; ?></p>
				</div>
			</div>

		</div>

</main>

<form method="post" action="delete_done.php">
	<input type="hidden" name="code" value="<?php print $pic_code; ?>">
	<input type="hidden" name="picture" value="<?php print $pic_picture; ?>">

	<div class="three-btn-group">
		<button type="submit" class="submit-btn btn">削除する！</button>
		<div class="btn-center">
			<button type="button" onclick="history.back()" class="one-back-btn btn">選択画面へ<br>戻る</button>
			<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
		</div>
	</div>
</form>			
<?php require_once('../includes/footer_admin.php'); ?>