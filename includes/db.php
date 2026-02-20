<?php
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
    // Render用：住所、ポート、名前を直接指定します
    $dsn = "pgsql:host=dpg-d6bclu2li9vc73derg70-a.singapore-postgres.render.com;port=5432;dbname=illustration";
    $user = "root";
    $password = "5xaAG0z3W1P5cxbCF1K3q13UmgpGB99b";
} else {
    // 自分のパソコン用
    $dsn = 'mysql:dbname=illustration;host=localhost;charset=utf8mb4';
    $user = 'root';
    $password = '';
}

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // テーブル作成命令（もしなければ作る）
    $dbh->exec("CREATE TABLE IF NOT EXISTS mst_illustration (code SERIAL PRIMARY KEY, picture TEXT, title TEXT, date DATE, comment TEXT);");
    $dbh->exec("CREATE TABLE IF NOT EXISTS mst_staff (code SERIAL PRIMARY KEY, name TEXT, password TEXT);");

} catch (PDOException $e) {
    // 原因を突き止めるために、エラーを直接出します
    echo "接続失敗: " . $e->getMessage();
    exit();
}
?>
