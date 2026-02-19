<?php
	require_once('../includes/session_login.php');

	require_once('../includes/sanitize.php');
	$post = sanitize($_POST);
	$pic_title = $post['title'];
	$pic_date = $post['date'];
	$pic_comment = $post['comment'];
	$pic_picture = $_FILES['picture'];	

	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');
?>

<main class="detail-container">

	<div class="h1-group">
		<h1 class="h1-add">イラストデータ登録</h1>
		<p class="h1-text">このイラストを登録しますか？</p>
	</div>

	<div class="detail">

		<div class="disp-pic">
			<?php if ($pic_picture['size'] === 0) { ?>
					<span class="check-none">画像が挿入されていません。</span>
			<?php } else { 
					move_uploaded_file($pic_picture['tmp_name'], 'uploaded_pic/'.$pic_picture['name']);
			?>
				 	<img src="uploaded_pic/<?php print $pic_picture['name']; ?>" class="pic-preview" alt="イラストプレビュー">
			<?php } ?>
		</div>

		<div class="disp-text">
			<div class="disp-text-group">
				<p class="disp-title">タイトル：</p>
				<p class="disp-content">
					<?php if ($pic_title === '') { $pic_title = 'no title'; ?>
							no title
					<?php } else { print $pic_title; } ?>
				</p>
			</div>
			<div class="disp-text-group">
				<p class="disp-title">制作日：</p>
				<p class="disp-content">
					<?php if ($pic_date === '') { $pic_date = '不明'; ?>
							不明
					<?php } else { print $pic_date; } ?>
				</p>
			</div>
			<div class="disp-text-group">
				<p class="disp-title">コメント：</p>
				<p class="disp-content">
					<?php if ($pic_comment === '') { ?>
						<span class="check-none">コメントが入力されていません。</span>
					<?php } else { print $pic_comment; } ?>
				</p>
			</div>
		</div>

	</div>
</main>
<!-- ここから下　変更前 -->
<?php if ($pic_picture['size'] === 0 || $pic_comment === '') { ?>
	<p class="error-text">イラストの挿入もしくはコメントが<br>入力されていません！</p>
	<div class="btn-center">
		<button type="button" onclick="history.back()" class="one-back-btn btn">入力画面へ<br>戻る</button>
		<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
	</div>

<?php } else { ?>
	<form method="post" action="add_done.php">
		<input type="hidden" name="picture_name" value="<?php print $pic_picture['name']; ?>">
		<input type="hidden" name="title" value="<?php print $pic_title; ?>">
		<input type="hidden" name="date" value="<?php print $pic_date; ?>">
		<input type="hidden" name="comment" value="<?php print $pic_comment; ?>">

		<div class="three-btn-group">
			<button type="submit" class="submit-btn btn">登録する！</button>
			<div class="btn-center">
				<button type="button" onclick="history.back()" class="one-back-btn btn">入力画面へ<br>戻る</button>
				<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
			</div>
		</div>
	</form>
<?php }

	require_once('../includes/footer_admin.php');
?>