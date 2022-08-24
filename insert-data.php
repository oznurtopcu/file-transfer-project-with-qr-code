<?php

try {

    $time = time();
    $uu_id = guidv4();

    $sql = "INSERT INTO file_table (file_name, file_directory,file_temp_name,date_time,time_value,uuid,m_type) 
            VALUES (null,null,null,null,'$time','$uu_id',null)";
    // use exec() because no results are returned
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();

    $stmt = $conn->prepare("SELECT uuid FROM file_table WHERE id=?");
    $stmt->bindParam(1, $last_id);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    $uuid = $result['uuid'];

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    echo "<br />";
}

?>