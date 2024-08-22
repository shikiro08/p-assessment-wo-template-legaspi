<?php
include 'config/db.php';
include 'controllers/UserController.php';

// Initialize the controller
$controller = new UserController($conn);

// Fetch all products
$products = $controller->getAllProducts();

// Display them in your HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Luo-Geh-Manufacturing</title>
</head>
<body>
    <div class="container my-5">
        <h2>Luo-Geh-Manufacturing</h2>
        <?php include 'navbar.php'; ?>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Components</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $products->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['ID']}</td>
                            <td>{$row['Product Name']}</td>
                            <td>{$row['Components']}</td>
                            <td>{$row['Supplier']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
