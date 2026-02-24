<?php require_once('../includes/head_admin.php'); ?>		
<header>
	<p class="header-title">
		ゆるめらくがき記録 <br>管理者専用サイト
	</p>
</header>

<main class="container">
	<div class="h1-group">
		<h1 class="h1-top">ログイン情報入力</h1>
		<p class="h1-text">ログインに必要な情報を入力してください。</p>
	</div>

	<form method="post" action="login_check.php">

		<div class="form">
			<label>
				<p>スタッフコードを入力してください。</p>
				<input type="text" name="code">
			</label>
			<label>
				<p>パスワードを入力してください。</p>
				<input type="password" name="pass">
			</label>

			<div class="btn-center">
				<button type="submit" class="submit-btn btn">ログインする</button>
			</div>
		</div>
	</form>
</main>
		
<?php require_once('../includes/footer_admin.php'); ?>