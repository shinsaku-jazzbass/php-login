<?php
require_once 'env.php';
echo "ok";
connect();

function connect()
{
    $host = DB_HOST;
    $db   = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    echo $host;
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    echo $dsn;
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
	echo '成功です！！';
        return $pdo;
    } catch(PDOExeption $e) {
        echo "aaaaaa";
        echo '接続失敗です！'. $e->getMessage();
        exit();
    }


}