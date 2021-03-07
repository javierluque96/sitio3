<?php
    require_once 'libs/Session.php';

    $session = Session::getSession();

    $session->loggedToLanding();

    if (isset($_POST["email"], $_POST["password"])) {
        $session->login($_POST["email"], $_POST["password"]);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Librarian Sign in</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/custom.css?v=<?php echo(rand()); ?>">
</head>

<body>

  <div class="hero-image hero-image-index">

    <div class="container">
      <div class="row align-items-center vh-100">
        <div class="col-md-8 col-lg-6 mx-auto">

          <form class="text-center p-5 border border-light rounded z-depth-3 rgba-index white-text" action="./"
            method="POST">
            <p class="h4 mb-4">Sign in</p>
            <input type="email" name="email" class="form-control mb-4" placeholder="E-mail" />
            <input type="password" name="password" class="form-control mb-4" placeholder="Password" />
            <button class="btn btn-info btn-block my-4" type="submit">
              Sign in
            </button>
            <p>
              Not a member?
              <a href="./register.html" class="cyan-text">Register</a>
            </p>
          </form>

        </div>
      </div>
    </div>

  </div>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper/core/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
