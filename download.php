<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=

    , initial-scale=1.0">
    <title>URL Shortening App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
          crossorigin="anonymous">
</head>
<body>
<?php

require_once 'db-conn.php';

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT id, file_temp_name, file_directory FROM file_table WHERE uuid=?");
$stmt->bindParam(1, $id);
$stmt->execute();


$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetch();

$resultType = gettype($result);

if ($resultType == 'boolean') {
    ?>
    <div class="alert alert-danger mt-5" role="alert">
        Connection timed out. Please try again.
    </div>
    <?php
    include 'index.php';
} elseif ($result['file_directory'] !== null) {
    header('Location: ' . $result['file_directory']);
} else {
    ?>
    <div class="alert alert-warning mt-5" role="alert">
        File upload is not complete. Please try again.
    </div>
    <?php
    include 'index.php';
}
?>

</body>
</html>