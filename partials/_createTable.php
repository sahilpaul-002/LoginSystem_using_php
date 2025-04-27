<?php
    require "partials/_createConnection.php";
    require "partials/_dbConnect.php";

    //Create a table in the database
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
        `sno` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(100) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    if (!mysqli_query($conn, $sql))
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failure. </strong> Tsble not created: ' . mysqli_error($conn) .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
?>