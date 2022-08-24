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
    echo "not_ready";
} elseif ($result['file_directory'] !== null) {
    echo "ready";
} else {
    echo "not_ready";
}

//download işlemi için sistemin hazır olup olmadığını kontrol ettik