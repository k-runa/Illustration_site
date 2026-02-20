<?php
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
    // Render用：URLをそのまま使って接続する（一番確実な方法です）
    $dsn = "pgsql:" . str_replace("postgresql://", "", $databaseUrl);
    // ユーザー名とパスワードをURLから抜き出す
    $dbopts = parse_url($databaseUrl);
    $user = $dbopts["user"];
    $password = $dbopts["pass"];
} else {
    // 自分のパソコン用
    $dsn = 'mysql:dbname=illustration;host=localhost;charset=utf8mb4';
    $user = 'root';
    $password = '';
}

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit;
}
?>
