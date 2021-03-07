<?php
  require_once './libs/Session.php';
  $session = Session::getSession();
  $session->logout();
