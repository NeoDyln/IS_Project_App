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
  // $logIn = $_POST['logOn'];
  $signUp = $_POST['signUp'];
  // $forgotPass = $_POST['resetReq'];

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

    else{
      // This will be the new db name
      $uniDb = mysqli_fetch_assoc($dbQuery);

      //  We then establish a connection to the new db

      $serverConn = new mysqli($serverName, $username, $password, $uniDb);

      if (!$serverConn){
        die($serverConn->connect_error." Database Connection Failed");
        exit();
      }

      $checkTable = "SELECT userNames FROM auth_table LIMIT 1";
      $checkTableQue = mysqli_query($serverConn, $checkTable);

      if($checkTableQue == FALSE){
        // Here, we know the table does not exist so we create it
        $authCreate = "CREATE TABLE auth_table(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, userMail VARCHAR(255) UNIQUE, userNames VARCHAR(255), userPass VARCHAR(255), userTel VARCHAR(255), teamInit VARCHAR(255),userRole VARCHAR(255) )";

        $authCreQue = mysqli_query($serverConn, $authCreate);
        // We then adda check to confirm it's been created
        if(!$authCreQue){
          exit();
          header("Location: ../index.html?AuthTableCreateFail");
        }
      }

      // We then insert the data into the table

      $insertStmt = $serverConn->prepare("INSERT INTO auth_table(userMail, userNames,userPass, userTel, teamInit, userRole) VALUES (?,?,?,?,?,?)");

      // For now, we set all user roles to standard
      $userRole = "Standard";

      $insertStmt->bind_param("sssiss", $userMail, $userNames, $userPass, $userTel, $uniInit, $userRole);

      $insertStmt->execute();

      // We can then check if the data has been inserted
      $checkInsert = mysqli_query($serverConn, "SELECT userNames FROM auth_table WHERE userNames = '.$userNames.' LIMIT 1");

      if(!$checkInsert){
        // If an error occurs in the above...
        exit();
        session_destroy();
        header("Location: ../index.html?AuthDataNotInserted");
      }

      // At this point, the data has been successfully inserted so we log the user in
      $_SESSION['userNames'] = $userNames;
      close();
      header("Location: ../app/chat.php");





    }


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
