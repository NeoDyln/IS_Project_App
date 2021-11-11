<?php
  session_start();
  include 'MainDirConnect.php';

  $dbConnLogIn = "Select Database inst_table";

  $LogOnquery = mysqli_query($serverConn, $dbConnPre);

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


  for ($TableCheck=1; $TableCheck>0; $TableCheck++) {
    if ($LogOnquery == true) {



      $TableCheck = 0
    }
    else {
      CREATE DATABASE inst_table;
    }
  }






 ?>
