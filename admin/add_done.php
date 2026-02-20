<?php
	require_once('../includes/session_login.php');
	
	$pic_picture_name = $_POST['picture_name'];
	
	require_once('../includes/sanitize.php');
	$post = sanitize($_POST);
	$pic_title = $post['title'];
	$pic_date = $post['date'];
	$pic_comment = $post['comment'];	

	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');
?>

<?php
	try {
		require_once('../includes/db.php');

		$sql = 'INSERT INTO mst_illustration(picture,title,date,comment) VALUES (?,?,?,?)';
		$stmt = $dbh->prepare($sql);
		$data[] = $pic_picture_name;
		$data[] = $pic_title;
		$data[] = $pic_date;
		$data[] = $pic_comment;
		$stmt->execute($data);

		$dbh = null;
?>
<main class="detail-container">

	<div class="h1-group">
		<h1 class="h1-add">イラストデータ登録</h1>
		<p class="h1-text">イラストの登録が完了しました！</p>
	</div>

	<div class="detail">

		<div class="disp-pic">
			<img src="uploaded_pic/<?php print $pic_picture_name; ?>">
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

<?php } catch (Exception $e) { ?>
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

<div class="btn-center">
	<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
</div>

<?php require_once('../includes/footer_admin.php'); ?>