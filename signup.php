<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />

    <title>Sign Up</title>
  </head>
  <body>
    <?php 
      require 'partials/_nav.php'; 
    ?>
    <?php
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // require "partials/_createConnection.php";
    require "partials/_dbCreate.php";
    require "partials/_createTable.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    //Check if the username already exists
    $exists = false;
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $checkResult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($checkResult) > 0)
    {
      $exists = true;
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Username already exists. Please try another username.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
    else 
    {
      $exists = false;

      //Check if the username and password are empty
      if ($password == "" || $confirmPassword == "")
      {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Password cannot be empty. Please try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>';
      }
      else
      {
        //Check user credentials 
        if($password == $confirmPassword && $exists == false)
        {
          $passwordHash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$passwordHash')";
          $result = mysqli_query($conn, $sql);
          //Check if the query was successful to show alert message
          if($result)
          {
            $showAlert = true;
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your account is created. You can login.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>';
          }
          else
          {
            $showAlert = false;
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Your account is not created. Please try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>';
          }
        }
        else if($password != $confirmPassword && $exists == false)
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Password do not match. Please try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
      }
    }
  }
  ?>

    <div class="container">
      <h1 class="text-center">Sing up to our website</h1>
    </div>

    <!-- Form -->
    <form action="/loginSystem/signup.php" method="post" class="container my-4">
      <div class="form-group">
        <label for="username">Username</label>
        <input
          type="text"
          maxlength="100"
          class="form-control"
          id="username"
          name="username"
          aria-describedby="usernameHelp"
        />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="password"
          maxlength="50"
          class="form-control"
          id="password"
          name="password"
        />
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input
          type="password"
          class="form-control"
          id="confirmPassword"
          name="confirmPassword"
        />
        <small id="confirm_password" class="form-text text-muted"
          >Make sure password entered is same as above</small>
      </div>
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
