<?php
  session_start();
  include 'MainTeamDirectory.php';

  $dbConnLogIn = "SELECT * FROM institutions where uniName == $uniQuery OR uniInit == $uniQuery";

  $LogOnquery = mysqli_query($serverConn, $dbConnLogIn);

  if ($LogOnQuery) {
    // code...
  } else {
    // code...
  }


  $logIn = $_POST['logOn'];
  $signUp = $_POST['signUp'];
  $forgotPass = $_POST['resetReq'];



  if (isset($logIn)) {
    $uniQuery = $
    // code...
  }
  elseif (isset($signUp)) {
    // code...
  }
  elseif (isset($resetReq)) {
    // code...
  }








 ?>
