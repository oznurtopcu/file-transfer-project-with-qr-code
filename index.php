<?php

require_once 'db-conn.php';
include 'time-control.php';
include 'insert-data.php';

$fileUploadUrl = "http://192.168.10.136/file-transfer-with-qr-code/file-upload.php?id=$uuid";
$qrcode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . $fileUploadUrl . "&choe=UTF-8";

?>

<!DOCTYPE html>
<html lang="en">

<div class="qr-card" style="height: 100vh" >

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=
    , initial-scale=1.0">
        <title>File Upload</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
              crossorigin="anonymous">
    </head>

    <body>
    <div class="container">
        <div class="row">
            <div class="qr-form d-flex justify-content-center mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        File Transfer App
                    </div>
                    <div class="card-body">
                        <?php
                        echo "<a href='$fileUploadUrl' target='_blank'><img src='{$qrcode}'></a><br/><br/><br/>";
                        ?>
                        <form action="download.php?id=<?php echo $uuid ?>" method="post"><br/>
                            <input class="btn btn-primary" type="submit" value="Download File">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setInterval(function() {
            fetch('download-check.php?id=<?php echo $uuid ?>')
                .then(function(response) {
                    response.text().then(function(text) {
                        if (text == "ready") {
                            window.location = "download.php?id=<?php echo $uuid ?>"
                        }
                    })
                })
        }, 1000)
    //her saniyede bir kontrol gerçekleştiriyor, ready mesajı gelirse direkt download sayfasına yönlendiriyor
    </script>
    </body>

</div>
</html>



