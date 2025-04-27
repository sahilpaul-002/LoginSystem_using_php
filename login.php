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

    <title>Log In</title>
  </head>
  <body>
    <?php 
      require 'partials/_nav.php'; 
    ?>
    <?php
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    require "partials/_dbConnect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    //Check username and password exist in database to log in the user
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $checkResult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($checkResult) == 0)
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Invalid username or password. Please try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
    else
    {
      //Check if the password is correct
      while ($row = mysqli_fetch_assoc($checkResult))
      {
        if (password_verify($password, $row["password"]))
        {
          $login = true;
          //Start session and set session variables
          session_start();
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          $_SESSION["password"] = $password;
          $_SESSION["userId"] = mysqli_fetch_assoc($checkResult)["sno"];
          //Rediret the user to welcome page
          header("location: index.php");
        }
        else
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Invalid username or password. Please try again.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>';
          break;
        }
      }
    }
  }
  ?>

    <div class="container">
      <h1 class="text-center">Log in to our website</h1>
    </div>

    <!-- Form -->
    <form action="/loginSystem/login.php" method="post" class="container my-4">
      <div class="form-group">
        <label for="username">Username</label>
        <input
          type="text"
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
          class="form-control"
          id="password"
          name="password"
        />
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
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
