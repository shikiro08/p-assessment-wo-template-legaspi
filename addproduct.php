<?php
include 'config/db.php';
include 'controllers/UserController.php';

$controller = new UserController($conn);

// Fetch all components to show in the form
$componentsResult = $conn->query("SELECT * FROM components");

// Initialize variables
$name = "";
$description = "";
$quantity = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $selectedComponents = isset($_POST['components']) ? $_POST['components'] : []; // Array of selected component IDs

    do {
        // Validate input
        if (empty($name) || empty($description) || empty($quantity)) {
            $errorMessage = "All fields, except components, are required.";
            break;
        }

        // Add the product to the database
        $productId = $controller->addProduct($name, $description, $quantity);

        if ($productId) {
            // Add the selected components to the product_components table
            foreach ($selectedComponents as $componentId) {
                $conn->query("INSERT INTO product_components (product_id, component_id) VALUES ($productId, $componentId)");
            }
            $successMessage = "Product and components added successfully!";
            // Clear the form data after success
            $name = $description = $quantity = "";
        } else {
            $errorMessage = "Failed to add product.";
        }

    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>
<body>
    <div class="container my-5">
        <h2>Add Product</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }

        if (!empty($successMessage)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Product Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($description); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Components</label>
                <div class="col-sm-6">
                    <select multiple class="form-control" name="components[]">
                        <?php
                        while ($row = $componentsResult->fetch_assoc()) {
                            echo "<option value='{$row['component_id']}'>{$row['component_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Products.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
