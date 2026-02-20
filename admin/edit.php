<?php
	require_once('../includes/session_login.php');
		
	$pic_code = $_GET['code'];

	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');

	try {
		require_once ('../includes/db.php');

		$sql = 'SELECT picture,title,date,comment FROM mst_illustration WHERE code=?';
		$stmt = $dbh->prepare($sql);
		$data[] = $pic_code;
		$stmt->execute($data);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$pic_picture_before = $rec['picture'];
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

<main class="container container-center">
	<div class="h1-group">
		<h1 class="h1-edit">イラストデータ編集</h1>
		<p class="h1-text">変更しない項目がある場合は未入力OK！</p>
	</div>
	<div class="disp-pic edit-before-preview">
		<p class="edit-before-text">\変更前の画像/</p>
		<img src="uploaded_pic/<?php print $pic_picture_before; ?>">
	</div>

		<form method="post" action="edit_check.php" enctype="multipart/form-data">
			<input type="hidden" name="code" value="<?php print $pic_code; ?>">
			<input type="hidden" name="picture_before" value="<?php print $pic_picture_before; ?>">

			<div class="form">
				<label>
					<p>任意のフォルダから画像をアップロードしてください。</p>
					<input type="file" name="picture_after">
				</label>
				<label>
					<p>タイトルを入力してください。</p>
					<input type="text" name="title" value="<?php print $pic_title; ?>">
				</label>
				<label>
					<p>描いた日付を入力してください。</p>
					<input type="text" name="date" value="<?php if ($pic_date === '0001-01-01') {print '不明';} else {print $pic_date;} ?>">
				</label>
				<label>
					<p>コメントを入力してください。</p>
					<textarea name="comment"><?php print $pic_comment; ?></textarea> 
				</label>
			</div>


			<div class="three-btn-group">
				<button type="submit" class="submit-btn btn">入力内容確認画面へ</button>
				<div class="btn-center">
					<button type="button" onclick="history.back()" class="one-back-btn btn">選択画面へ<br>戻る</button>
					<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
				</div>
			</div>
		
		</form>
	
</main>

<?php require_once('../includes/footer_admin.php'); ?>