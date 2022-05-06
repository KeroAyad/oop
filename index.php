<?php
include "action.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <h1 class="container py-3 bg-light text-center">Title </h1>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET["update"])) {
                // if (isset($_GET["id"])) {
                //     $id = $_GET["id"];
                // }
                $id = $_GET["id"] ?? null;
                $where = array("id" => $id,);
                $row = $obj->select_record("med", $where);
            ?>
                <form action="action.php" method="post" class="border rounded-3 border-info col-8 mx-auto p-0">
                    <div class="bg-info m-0 px-2 fs-4 rounded-top">Header</div>
                    <input type="hidden" value="<?= $row["id"] ?>" name="id">
                    <div class=" container my-3">
                        <label for="" class="col-form-label">Name</label>
                        <input type="text" required value="<?= $row["name"] ?>" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class=" container my-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="number" required value="<?= $row["number"] ?>" class="form-control" name="qty" placeholder="Enter Quantity">
                    </div>
                    <button type="submit" name="edit" class=" ms-4 mb-4 btn btn-info">Update</button>
                </form>
            <?php
            } else {
            ?>
                <form action="action.php" method="post" class="border rounded-3 border-info col-8 mx-auto p-0">
                    <div class="bg-info m-0 px-2 fs-4 rounded-top">Header</div>
                    <div class=" container my-3">
                        <label for="" class="col-form-label">Name</label>
                        <input type="text" required class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class=" container my-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="number" required class="form-control" name="qty" placeholder="Enter Quantity">
                    </div>
                    <button type="submit" name="submit" class=" ms-4 mb-4 btn btn-info">Store</button>
                </form>
            <?php

            }

            ?>

        </div>
    </div>
    <div class="container mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $myRow = $obj->fetch_record("med");
                foreach ($myRow as $row) {
                ?>

                    <tr>
                        <th scope="row"><?= $row["id"] ?></th>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row["number"] ?></td>
                        <td>
                            <a href="index.php?update=1&id=<?= $row["id"] ?>" class="btn btn-info">update</a>
                        </td>
                        <td><a href="action.php?deleteid=<?= $row["id"] ?>" class="btn btn-danger">delete</a></td>
                    </tr>
                <?php
                }
                ?>


            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>