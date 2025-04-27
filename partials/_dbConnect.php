<?php
require "partials/_createConnection.php";

$dbName = "loginSystem";
// Connect to the database
mysqli_select_db($conn, $dbName);
if (!$conn) 
{
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Failed to connect to database: ' . mysqli_connect_error() . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
  die("Connection failed: " . mysqli_connect_error());
}
?>