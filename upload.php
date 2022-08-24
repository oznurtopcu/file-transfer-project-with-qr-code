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

$getFile = $_FILES["fileUpload"];
$dateTime = date("Y-m-d H:i:s", time());
$timeValue = time();
$x = 0;

$fileName = guidv4(); //dosya adını uuid ile gizledik
$fileType = $getFile["type"];
$fileTmpName = $getFile["tmp_name"];
$fileError = $getFile["error"];
$fileSize = $getFile["size"];
$id = $_GET["id"];

$fileDirectory = "Documents/" . $fileName;

// DB::table('mime_type')->get()->pluck('mime_type')

$stmt = $conn->prepare("SELECT mime_type FROM mime_table");
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

if (in_array($fileType, array_column($result, 'mime_type'))) {

    if (move_uploaded_file($fileTmpName, $fileDirectory)) {
        try {
            $sql_file = $conn->prepare("UPDATE file_table SET file_name = '$fileName',
                      file_directory = '$fileDirectory',
                      file_temp_name = '$fileTmpName',
                      date_time = '$dateTime',
                      time_value='$timeValue',
                      m_type = '$fileType' WHERE uuid =?");
            $sql_file->bindParam(1, $id);
            $sql_file->execute();

        } catch (PDOException $e) {
            echo $sql_file . "<br>" . $e->getMessage();
            echo "<br />";
        }
    } else {
        $sql_file = null;
    }

    if ($sql_file == null) {
        ?>
        <div class="alert alert-warning mt-5" role="alert">
            An unknown error occurred while uploading the file. Please try again.
        </div>
        <?php
        include 'file-upload.php';
    } else {
        ?>
        <div class="alert alert-success mt-5" role="alert">
            File upload completed successfully.
        </div>
        <?php
    }
} else {
    ?>
    <div class="alert alert-danger mt-5" role="alert">
        Invalid file format. Please try again.
    </div>
    <?php
    include 'file-upload.php';
}


?>


</body>
</html>