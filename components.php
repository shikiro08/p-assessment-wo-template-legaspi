<?php
include 'config/db.php';
include 'controllers/UserController.php';

// Initialize the controller
$controller = new UserController($conn);

// Fetch all products
$products = $controller->getAllComponents();

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
        <a class="btn btn-primary" href="addcomponent.php" role="button">Add components</a>
        <?php include'navbar.php';?>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Component name</th>
                <th>Description</th>
                <th>Supplier</th>
                <!--<th>Action</th>-->
            </thead>
            <?php
            while ($row = $products->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['Component Name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['Supplier']}</td>
                   <!--<td>
                        <a class='btn btn-primary bt-sm' href='/controller/edit.php?id=$row[ID]'>edit</a>
                        <a class='btn btn-danger btn-sm' href='/controller/delete/php?id=$row[ID]'>delete</a>
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
