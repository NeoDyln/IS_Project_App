<?php
  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  elseif(session_status() === PHP_SESSION_NONE) session_start();
  include 'serverConnector.php';

  // We will also save the main database name for ease of access
  $mainDb = "interappconn";

  // We will also create the connection statement

  $serverConn = new mysqli($serverName, $username, $password, $mainDb);

  if (!$serverConn) {
    close();
    session_destroy();
    header('Location: ../index.html?ServerUnavailable');

  }

  // We then fetch the type of query as a variable
  $logIn = $_POST['logOn'];
  $signUp = $_POST['signUp'];
  $forgotPass = $_POST['resetReq'];

  // For each type, a different action is done

  // For log in function
  if (isset($logIn)) {
    // code...
  }


  // For account creation function
  elseif (isset($signUp)) {

    // We collect the form Data
    $uniInit = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniQuery']));
    $userNames =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userNames']));
    $userMail =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userMail']));
    $userTel =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userTel']));
    $userPass =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userPass']));

    // We then collect the uniDbID of the selected university

    $dbGet = "SELECT uniDatabaseID FROM institutions WHERE uniInit = '.$uniInit.' ";
    $dbQuery = mysqli_query($serverConn, $dbGet);

    if (!$dbQuery) {
      close();
      session_destroy();
      header('Location: ../index.html?UniDetailsUnretrieved');
    }

    $


  }
  elseif (isset($resetReq)) {
    // code...
  }
  else{
    close();
    session_destroy();
    header("Location: ../index.html?WrongAccess");
  }








 ?>
