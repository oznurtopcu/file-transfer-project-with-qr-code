<?php

$timeLimit=time()-300;

try {
    $stmt = $conn->prepare("SELECT file_directory,time_value FROM file_table WHERE time_value<'$timeLimit'");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

        foreach ($result as $element) {

            $fileDir = $element["file_directory"];

            if($fileDir !== null) {
                unlink($fileDir);
            }
        }
        $sql = "DELETE FROM file_table WHERE  time_value<'$timeLimit'";
        $conn->exec($sql);
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
?>