
<?php
require_once "includes/config.php";  // Include the database configuration
require_once "includes/login.php";  // Include the Login class

$db = (new Database())->connect();  // Create a database connection
$login = new Login($db);  // Pass the database connection to the Login class
$login->logout();  // Call the logout method
