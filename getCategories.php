<?php
//categories set for updating
include_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
$table = CATEGORIES;
$pdo = dbConnection();
//table categories truncate
try {
    $stmt = $pdo -> prepare("
        TRUNCATE `$table` ");
    $stmt -> execute([':email' => $email]);
}catch (PDOException $e){
    echo "Category truncate error: " . $e -> getMessage();
    die;
}
//categories set insert into the categories table
foreach ( $categories as $category ) {
    try {
        $stmt = $pdo -> prepare("
            INSERT INTO `$table` (`category`)
            VALUES (:category)");
        $stmt -> execute([':category' => $category]);
    }catch (PDOException $e){
        echo "Category insert error: " . $e -> getMessage();
        die;
    }
}
echo json_encode($categories);