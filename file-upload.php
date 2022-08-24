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
                        <form action="upload.php?id=<?php echo $_GET["id"]?>" method ="post" enctype="multipart/form-data">

                            Select the file to upload:<br /><br />
                            <input type ="file" name="fileUpload"><br /><br /><br />
                            <!-- form üzerinde herhangi bir değişiklik olması durumunda submit ediyor -->
                            <input class="btn btn-primary" type ="submit" value="Send File">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

</div>
</html>