<?php 

$main_dir = $_SERVER['DOCUMENT_ROOT'];

require_once $main_dir . '/engine/config.php';

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    $pdo = new PDO($dsn, $db_login, $db_password, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>