<?php
include_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
$table = EMAIL_NAME;
$email = $_GET['email'];
$pdo = dbConnection();
try {
    $stmt = $pdo -> prepare("
      SELECT `name`
      FROM `$table`
      WHERE `email` = :email");
    $stmt -> execute([':email' => $email]);
    $name = $stmt->fetchColumn();
    if (  !$name ) {$name = '';}
    echo json_encode($name);
}catch (PDOException $e){
    echo "Selection error: " . $e -> getMessage();
    die;
}
