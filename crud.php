<?php
    require_once 'libs/Session.php';
    $session = Session::getSession();
    
    if (!($session->logged() && $session->checkAdmin())):
        $session->redirect("./");
    endif;

    if (isset($_POST["id_user"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["address"], $_POST["phone"], $_POST["user_type"])) {
        $id = intval($_POST["id_user"]);
        $user_type = intval($_POST["user_type"]);

        $user = new User($id, $_POST["name"], $_POST["surname"], $user_type, $_POST["email"], $_POST["password"], $_POST["address"], $_POST["phone"]);
        $user->update();
        
    } else {
        if (isset($_GET["id_user"])) {
            $id = intval($_GET["id_user"]);
            $user = new User($id, "", "", "", "", "", "", "");
            $user->delete();
        }
    }
    $session->redirect("./");

    