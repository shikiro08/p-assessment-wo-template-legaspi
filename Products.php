<?php
include 'config/db.php';
include 'controllers/UserController.php';

// Initialize the controller
$controller = new UserController($conn);

// Fetch all products
$products = $controller->getAllProducts();

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
		<a class="btn btn-primary" href="addproduct.php" role="button">Add product</a>
		<?php include'navbar.php';?>
		<table class="table">
			<thead>
				<th>ID</th>
				<th>Product name</th>
				<th>Description</th>
				<th>Components</th>
				<th>Quantity</th>
				<!--<th>Action</th>-->
			</thead>
			<?php
			while ($row = $products->fetch_assoc()) {
			    echo "<tr>
			        <td>{$row['ID']}</td>
			        <td>{$row['Product Name']}</td>
			        <td>{$row['description']}</td>
			        <td>{$row['Components']}</td>
			        <td>{$row['quantity']}</td>
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
