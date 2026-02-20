<?php
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
    $dbopts = parse_url($databaseUrl);
    $dsn = "pgsql:host=" . $dbopts["host"] . ";port=5432;dbname=" . ltrim($dbopts["path"], '/');
    $user = $dbopts["user"];
    $password = $dbopts["pass"];
} else {
    $dsn = 'mysql:dbname=illustration;host=localhost;charset=utf8mb4';
    $user = 'root';
    $password = '';
}

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Render側に正しい「棚」を2つ作ります
    $dbh->exec("CREATE TABLE IF NOT EXISTS mst_illustration (
        code SERIAL PRIMARY KEY,
        picture TEXT,
        title TEXT,
        date DATE,
        comment TEXT
    );");

    $dbh->exec("CREATE TABLE IF NOT EXISTS mst_staff (
        code SERIAL PRIMARY KEY,
        name TEXT,
        password TEXT
    );");

} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit;
}
?>
