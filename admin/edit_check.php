<?php
	require_once('../includes/session_login.php');

	require_once('../includes/sanitize.php');
	$post = sanitize($_POST);
	$pic_code = $post['code'];
	$pic_picture_before = $post['picture_before'];
	$pic_title_after = $post['title'];
	$pic_date_after = $post['date'];
	$pic_comment_after = $post['comment'];
	$pic_picture_after = $_FILES['picture_after'];

	require_once ('../includes/head_admin.php');
	require_once ('../includes/header_admin.php');

try {	
	require_once ('../includes/db.php');

	$sql = 'SELECT title,date,comment FROM mst_illustration WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $pic_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$pic_title_before = $rec['title'];
	$pic_date_before = $rec['date'];
	$pic_comment_before = $rec['comment'];

	$dbh = null;

	$pic_not_change = 
		$pic_picture_after['size'] === 0 
		|| $pic_picture_after['name'] === $pic_picture_before;
		
	$text_not_change = 
		$pic_title_after === $pic_title_before
		&& $pic_date_after === $pic_date_before
		&& $pic_comment_after === $pic_comment_before;

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
		<h1 class="h1-edit">イラストデータ編集</h1>
		<p class="h1-text">この変更で確定しますか？</p>
	</div>
	<div class="grid-edit">
		<div class="detail-2column">

			<div class="h2-group">
				<h2 class="h2-edit h2-edit-before">変更前</h2>
			</div>

			<div class="disp-pic">
				<img src="uploaded_pic/<?php print $pic_picture_before; ?>">
			</div>
			<div class="disp-text">
				<div class="disp-text-group">
					<p class="disp-title">タイトル：</p>
					<p class="disp-content"><?php print $pic_title_before; ?></p>
				</div>
				<div class="disp-text-group">
					<p class="disp-title">制作日：</p>
					<p class="disp-content">
						<?php if ($pic_date_before === '0001-01-01') {
								print '不明';
							} else {
								print $pic_date_before;
							}
						?>
					</p>
				</div>
				<div class="disp-text-group">
					<p class="disp-title">コメント：</p>
					<p class="disp-content"><?php print $pic_comment_before; ?></p>
				</div>
			</div>

		</div>


		<div class="detail-2column">

			<div class="h2-group">
				<h2 class="h2-edit h2-edit-after">変更後</h2>
			</div>

			<div class="disp-pic">
				<?php 
					if ($pic_not_change) {
				?>
						<img src="uploaded_pic/<?php print $pic_picture_before; ?>">
						
				<?php
					} else { 
						move_uploaded_file($pic_picture_after['tmp_name'], 'uploaded_pic/'.$pic_picture_after['name']);
				?>
						<img src="uploaded_pic/<?php print $pic_picture_after['name']; ?>" alt="イラストプレビュー">
				<?php
					}
				?>
			</div>

			<div class="disp-text">
				<div class="disp-text-group">
					<p class="disp-title">タイトル：</p>
					<div class="disp-content">
						<?php
							if ($pic_title_after === $pic_title_before) {	
								print $pic_title_before;
							} else {
								print $pic_title_after;
							}
						?>
					</div>
				</div>

				<div class="disp-text-group">
					<p class="disp-title">制作日：</p>
					<div class="disp-content">
						<?php
							if ($pic_date_after === $pic_date_before || $pic_date_after === '') {
								$target_date = $pic_date_before; 
							} else {
								$target_date = $pic_date_after;
							}

							if ($target_date === '0001-01-01') {
								print '不明';
							} else {
								print $target_date;
							}
						?>
					</div>
				</div>

				<div class="disp-text-group">
					<p class="disp-title">コメント：</p>
					<div class="disp-content">
						<?php
							if ($pic_comment_after === $pic_comment_before) {
								print $pic_comment_before;
						?>
						<?php
							} else {
								print $pic_comment_after;
							}
						?>
					</div>
				</div>

			</div>

		</div>
	</div>
</main>

<?php
	if ($pic_not_change && $text_not_change) {
?>
	<div>
		<p class="error-text">変更箇所がありません！</p>
		<div class="btn-center">
			<button type="button" onclick="history.back()" class="one-back-btn btn">編集画面へ<br>戻る</button>
			<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
		</div>
	</div>
<?php
	} else {
?>

	<div>
		<form method="post" action="edit_done.php">
			<input type="hidden" name="code" value="<?php print $pic_code; ?>">

			<input type="hidden" name="picture" value="<?php if ($pic_not_change) { print $pic_picture_before;} else { print $pic_picture_after['name']; } ?>">
			<input type="hidden" name="title" value="<?php if ($pic_title_after === $pic_title_before) { print $pic_title_before; } else { print $pic_title_after; } ?>">
			<input type="hidden" name="date" value="<?php if ($pic_date_after === $pic_date_before) { print $pic_date_before; } else { print $pic_date_after; } ?>">
			<input type="hidden" name="comment" value="<?php if ($pic_comment_after === $pic_comment_before) { print $pic_comment_before; } else { print $pic_comment_after; } ?>">

			<div class="three-btn-group">
				<button type="submit" class="submit-btn btn">編集完了！</button>
				<div class="btn-center">
					<button type="button" onclick="history.back()" class="one-back-btn btn">編集画面へ<br>戻る</button>
					<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
				</div>
			</div>

		</form>
	</div>
<?php
	}

require_once('../includes/footer_admin.php');
?>