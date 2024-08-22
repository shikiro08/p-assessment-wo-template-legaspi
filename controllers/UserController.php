<?php
session_start();
class UserController {

    private $conn;

    // Constructor that accepts the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Function to get all products
    public function getAllProducts() {
    $sql = "SELECT p.p_id AS 'ID', 
                   p.p_name AS 'Product Name', 
                   p.description AS 'description', 
                   p.quantity AS 'quantity',
                   GROUP_CONCAT(DISTINCT c.component_name SEPARATOR ', ') AS 'Components',
                   GROUP_CONCAT(DISTINCT s.sup_name SEPARATOR ', ') AS 'Supplier'
            FROM product p
            LEFT JOIN product_components pc ON p.p_id = pc.product_id
            LEFT JOIN components c ON pc.component_id = c.component_id
            LEFT JOIN component_suppliers cs ON c.component_id = cs.component_id
            LEFT JOIN supplier s ON cs.supplier_id = s.sup_id
            GROUP BY p.p_id";

    $result = $this->conn->query($sql);

    if (!$result) {
        throw new Exception("Invalid query: " . $this->conn->error);
    }

    if ($result->num_rows == 0) {
        return null; // or you could return an empty array depending on how you handle the results
    }

    return $result;
    }

    // Function to get a single product by ID
    public function getProductById($id) {
        $sql = "SELECT p.p_id AS 'ID', p.p_name AS 'Product Name',
                       GROUP_CONCAT(DISTINCT c.component_name SEPARATOR ', ') AS 'Components',
                       GROUP_CONCAT(DISTINCT s.sup_name SEPARATOR ', ') AS 'Supplier'
                FROM product p
                LEFT JOIN product_components pc ON p.p_id = pc.product_id
                LEFT JOIN components c ON pc.component_id = c.component_id
                LEFT JOIN component_suppliers cs ON c.component_id = cs.component_id
                LEFT JOIN supplier s ON cs.supplier_id = s.sup_id
                WHERE p.p_id = $id
                GROUP BY p.p_id";

        $result = $this->conn->query($sql);

        if (!$result) {
            die("Invalid query: " . $this->conn->error);
        }

        return $result->fetch_assoc();
    }

    // Function to add a new product
    public function addProduct($name, $description, $quantity) {
        $sql = "INSERT INTO product (p_name, description, quantity) VALUES ('$name', '$description', $quantity)";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Invalid query: " . $this->conn->error);
        }

        return $this->conn->insert_id; // return the ID of the newly inserted product
    }

    // Function to update an existing product
    public function updateProduct($id, $name, $description, $quantity) {
        $sql = "UPDATE product SET p_name='$name', description='$description', quantity=$quantity WHERE p_id=$id";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Invalid query: " . $this->conn->error);
        }

        return true;
    }

    // Function to delete a product by ID
    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE p_id=$id";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Invalid query: " . $this->conn->error);
        }

        return true;
    }
    //function to get all components data
    public function getAllComponents() {
    $sql = "SELECT c.component_id AS 'ID', 
                   c.component_name AS 'Component Name', 
                   c.description AS 'description', 
                   GROUP_CONCAT(DISTINCT p.p_name SEPARATOR ', ') AS 'Products',
                   GROUP_CONCAT(DISTINCT s.sup_name SEPARATOR ', ') AS 'Supplier'
            FROM components c
            LEFT JOIN product_components pc ON c.component_id = pc.component_id
            LEFT JOIN product p ON pc.product_id = p.p_id
            LEFT JOIN component_suppliers cs ON c.component_id = cs.component_id
            LEFT JOIN supplier s ON cs.supplier_id = s.sup_id
            GROUP BY c.component_id";

    $result = $this->conn->query($sql);

    if (!$result) {
        throw new Exception("Invalid query: " . $this->conn->error);
    }

    if ($result->num_rows == 0) {
        return null; // or you could return an empty array depending on how you handle the results
    }

    return $result;
    }

    public function addComponent($name, $description) {
        $sql = "INSERT INTO components (component_name, description) VALUES ('$name', '$description')";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Invalid query: " . $this->conn->error);
        }

        return $this->conn->insert_id; // return the ID of the newly inserted product
    }

    public function getAllSuppliers() {
    $sql = "SELECT * FROM supplier";

    $result = $this->conn->query($sql);

    if (!$result) {
        throw new Exception("Invalid query: " . $this->conn->error);
    }

    if ($result->num_rows == 0) {
        return null; // or you could return an empty array depending on how you handle the results
    }

    return $result;
    }

    public function addSupplier($name, $c_number, $address) {
        $sql = "INSERT INTO supplier (sup_name, c_number, address) VALUES ('$name', '$c_number', '$address')";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Invalid query: " . $this->conn->error);
        }

        return $this->conn->insert_id; // return the ID of the newly inserted product
    }
    
}
