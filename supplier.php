<?php
include 'config/db.php';
include 'controllers/UserController.php';

// Initialize the controller
$controller = new UserController($conn);

// Fetch all products
$supplier = $controller->getAllSuppliers();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title></title>
</head>
<body>
    <div class="container my-5">
        <h2>Luo-Geh-Manufacturing</h2>
        <a class="btn btn-primary" href="addSupplier.php" role="button">Add supplier</a>
        <?php include'navbar.php';?>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Supplier name</th>
                <th>Contact No.</th>
                <th>Address</th>
                <!--<th>Action</th>-->
            </thead>
            <?php
            while ($row = $supplier->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['sup_id']}</td>
                    <td>{$row['sup_name']}</td>
                    <td>{$row['c_number']}</td>
                    <td>{$row['address']}</td>
                    <!--<td>
                        <a class='btn btn-primary bt-sm' href='/controller/edit.php?id=$row[sup_id]'>edit</a>
                        <a class='btn btn-danger btn-sm' href='/controller/delete/php?id=$row[sup_id]'>delete</a>
                    </td>-->
                </tr>";
            }
            ?>

            <tbody>

            </tbody>
        </table>
    </div>

</body>
</html>
