<?php
  require_once '../libs/Session.php';
  $session = Session::getSession();
  
  if (!($session->logged() && $session->checkLibrarian())):
      $session->redirect("../");
  endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Librarian</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/font-awesome.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="../css/mdb.min.css" />
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="../css/custom.css?v=<?php echo(rand()); ?>">
</head>

<body>
  <div class="hero-image">
    <div class="container">
      <div class="row align-items-center" style="height: 75vh;">
        <div class="col-md-6 mx-auto text-center white-text rgba-stylish-strong p-5 rounded">
          <h1>Welcome to Librarian</h1>
          <p>You are on the librarian side</p>
          <a href="../signOut.php" class="mt-4 btn btn-light rounded-pill">Sign out</a>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper/core/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>

</html>
