<?php
include_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
$pdo = dbConnection();
//params getting
$email = $_GET['email'];
$name  = $_GET['name'];
$comment = $_GET['comment'];
$posted_categories = $_GET['posted_categories'];
$table = EMAIL_NAME;
// email & name saving if not saved earlier
try {
    $stmt = $pdo -> prepare("
        SELECT `email`
        FROM `$table`
        WHERE `email` = :email");
    $stmt -> execute([':email' => $email]);
    $email_exist = $stmt->fetchColumn();
    // is email not saved earlier ?
    if (  !$email_exist ) {
        //email & name saving
        try {
            $stmt = $pdo -> prepare("
                INSERT INTO `$table` (`email`,`name`)
                VALUES ( :email, :name )");
            $stmt -> execute([':email' => $email, ':name' => $name]);
        }catch (PDOException $e)
            {
                echo "Email insert error: " . $e -> getMessage();
                die;
            }
    }
}catch (PDOException $e){
    echo "Email select error: " . $e -> getMessage();
    die;
}
// comment saving
$table = COMMENTS;
try {
    $stmt = $pdo -> prepare("
        INSERT INTO `$table` (`email`,`comment`)
        VALUES ( :email, :comment )");
    $stmt -> execute([':email' => $email, ':comment' => $comment]);
    // saved comment id
    $id_comment = $pdo -> lastInsertId();
}catch (PDOException $e)
{
    echo "Comment insert error: " . $e -> getMessage();
    die;
}
$table = COMMENT_CATEGORIES;
$table_categories = CATEGORIES;
foreach( $posted_categories  as $category ){
    //id category select
    try { $stmt = $pdo -> prepare("
          SELECT `id_category`
          FROM `$table_categories`
          WHERE `category` = :category");
        $stmt -> execute([':category' => $category]);
        $id_category = $stmt->fetchColumn();
    }
    catch (PDOException $e)
{
    echo "Category select error: " . $e -> getMessage();
    die;
}
    try {
        //comment categories saving
        $stmt = $pdo -> prepare("
            INSERT INTO `$table` (`id_comment`,`id_category`)
            VALUES ( :id_comment, :id_category )");
        $stmt -> execute([':id_comment' => $id_comment,
            ':id_category' => $id_category]);
    }catch (PDOException $e)
    {
        echo "Id_comment & id_category insert error: " . $e -> getMessage();
        die;
    }
}
echo json_encode(true);