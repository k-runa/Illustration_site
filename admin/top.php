<?php
	require_once('../includes/session_login.php');

	require_once('../includes/head_admin.php');
	require_once('../includes/header_admin.php');
?>

<main class="container">
    <div class="h1-group">
        <h1 class="h1-top">イラスト管理トップメニュー</h1>
        <p class="h1-text">イラストの登録・編集・参照・削除を行えます。</p>
    </div>

    <div class="menu-grid">
        <a href="add.php" class="menu-item menu-item-add">イラスト登録</a>
        <a href="edit_select.php" class="menu-item menu-item-edit">イラスト編集</a>
        <a href="disp_select.php" class="menu-item menu-item-view">イラスト参照</a>
        <a href="delete_select.php" class="menu-item menu-item-delete">イラスト削除</a>
    </div>
</main>

<?php require_once('../includes/footer_admin.php'); ?>