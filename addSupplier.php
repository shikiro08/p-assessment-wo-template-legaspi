<?php
include 'config/db.php';
include 'controllers/UserController.php';

$controller = new UserController($conn);

// Fetch all components to show in the form
$supplierResult = $conn->query("SELECT * FROM supplier");

// Initialize variables
$name = "";
$c_number = "";
$address = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $c_number = $_POST['c_number'];
    $address = $_POST['address'];
    do {
        // Validate input
        if (empty($name) || empty($c_number) || empty($address)) {
            $errorMessage = "All fields, except components, are required.";
            break;
        }

        // Add the product to the database
        $supplierId = $controller->addSupplier($name, $c_number, $address);

        if ($supplierId) {

            $successMessage = "Product and components added successfully!";
            // Clear the form data after success
            $name = $c_number = $address = "";
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
                <label class="col-sm-3 col-form-label">Supplier Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact No.</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="c_number" value="<?php echo htmlspecialchars($c_number); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="supplier.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
