<?php
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
    $dbopts = parse_url($databaseUrl);
    $dsn = "pgsql:host=" . $dbopts["host"] . ";port=" . $dbopts["port"] . ";dbname=" . ltrim($dbopts["path"], '/');
    $user = $dbopts["user"];
    $password = $dbopts["pass"] ?? '';
} else {
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
