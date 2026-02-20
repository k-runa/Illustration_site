<?php
	require_once('../includes/session_login.php');

	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');
?>

<main class="container">
	<div class="h1-group">
		<h1 class="h1-add">イラストデータ登録</h1>
		<p class="h1-text">登録したいイラストのファイルを選択・<br>入力項目への記入をしてください。</p>
	</div>
	<form method="post" action="add_check.php" enctype="multipart/form-data">

		<div class="form">
			<label>
				<p><span class="required">必須</span>任意のフォルダから画像をアップロードしてください。</p>
				<input type="file" name="picture">
			</label>
			<label>
				<p>タイトルを入力してください。</p>
				<input type="text" name="title" placeholder="no title">
			</label>
			<label>
				<p>描いた日付をすべて半角で入力してください。</p>
				<input type="text" name="date" placeholder="2025-10-05">
			</label>
			<label>
				<p><span class="required">必須</span>コメントを入力してください。</p>
				<textarea name="comment" placeholder="数日間ちまちま息抜きに描いた！( ☉_☉ )✏️"></textarea>
			</label>
		</div>

	<div class="btn-center">
		<a href="top.php" class="top-back-btn btn">トップページへ<br>戻る</a>
		<button type="submit" class="submit-btn-2column btn">入力内容<br>確認画面へ</button>
	</div>
	</form>	
</main>

<?php require_once('../includes/footer_admin.php'); ?>