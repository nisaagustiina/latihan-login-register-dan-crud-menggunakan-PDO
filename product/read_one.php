<?php

session_start();

// check user login
if (empty($_SESSION['user_id'])) {
    header("Location: ../index");
}
// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once '../database/database.php';
include_once '../controller/product.php';
include_once '../controller/category.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$product = new Product($db);

 
// set ID property of product to be read
$product->id = $id;
 
// read the details of product to be read
$product->readOne();
include_once "../layout_navbar.php";
// set page headers
$page_title = "Read One Product";
include_once "../layout_header.php";
 
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='read_template' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Products";
    echo "</a>";
echo "</div>";
 // HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$product->name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Price</td>";
        echo "<td>&#36;{$product->price}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Description</td>";
        echo "<td>{$product->description}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>";
            // display category name
            $category->id=$product->category_id;
            $category->readName();
            echo $category->name;
        echo "</td>";
    echo "</tr>";
 echo "<tr>";
    echo "<td>Image</td>";
    echo "<td>";
        echo $product->image ? "<img src='uploads/{$product->image}' style='width:300px;' />" : "No image found.";
    echo "</td>";
echo "</tr>";
echo "</table>";
// set footer
include_once "../layout_footer.php";
