<?php
  require_once '../libs/Session.php';
  $session = Session::getSession();
  
  if (!($session->logged() && $session->checkAdmin())):
      $session->redirect("../");
  endif;

  $users = User::getUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Librarian</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/fontawesome/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="../css/mdb.min.css" />
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="../css/custom.css?v=<?php echo(rand()); ?>">
</head>

<body class="rgba-stylish-strong">
    <div class="hero-image">
        <header class="container">
            <div class="row align-items-center vh-100 p-2 p-md-0">
                <div class="col-md-6 mx-auto text-center white-text rgba-stylish-strong p-5 rounded">
                    <h1>Welcome to Librarian</h1>
                    <p>You are on the admin side</p>
                    <a href="#user-list" class="mt-4 btn btn-light rounded-pill">Go to User List</a>
                </div>
            </div>
        </header>
        <main class="container-fluid pt-5 px-lg-5">
            <h1 id="user-list" class="white-text pt-4 mb-4 text-center">User List</h1>
        
            <div class='row text-left'>
            <?php
                for ($i = 0; $i < count($users); $i++):
            ?>
                <div class='col-12 col-md-6 col-lg-4 user'>
                    <div class='card p-3 my-3'>
                        <div class='card-body'>
                            <form class='text-center' method="POST" action="../crud.php">
                                <input type="hidden" name="id_user" value="<?= $users[$i]->getId() ?>">
                                <input type="hidden" name="password" value="<?= $users[$i]->getPassword() ?>">
                                <div class="md-form">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="<?= $users[$i]->getEmail() ?>">
                                </div>
                                <!-- <div class="md-form">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control" value="<?= $users[$i]->getPassword() ?>">
                                </div> -->
                                <div class="md-form">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= $users[$i]->getName() ?>">
                                </div>
                                <div class="md-form">
                                    <label for="surname">Surname</label>
                                    <input type="text" name="surname" class="form-control" value="<?= $users[$i]->getSurname() ?>">
                                </div>
                                <div class="md-form">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" value="<?= $users[$i]->getAddress() ?>">
                                </div>
                                <div class="md-form">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?= $users[$i]->getPhone() ?>">
                                </div>
                                <div class="form-group text-left">
                                    <select class="browser-default custom-select custom-select-sm" name="user_type">
                                        <option value="<?= $users[$i]->getUserType() ?>" selected>Permissions: <?= $users[$i]->getUserTypeString() ?></option>
                                        <option value="1">Admin</option>
                                        <option value="10">Librarian</option>
                                        <option value="20">Student</option>
                                    </select>
                                </div>
                                <button type='submit' class='btn btn-warning'>
                                    <i class='far fa-edit'></i>
                                </button>    
                                <a class='btn btn-danger' href="../crud.php?id_user=<?= $users[$i]->getId() ?>">
                                    <i class='far fa-trash-alt'></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
                endfor;
            ?>
            
        </div>
        <div class="text-center">
            <a href="../signOut.php" class="mt-4 mb-5 btn btn-light rounded-pill">Sign out</a>
        </div>
    </main>

   

  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper/core/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>

</html>
