<?php
// Establish a connection to the database by importing serverconnector
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();



include '../serverConnector.php';


  if (isset($_POST['signUp'])) {

    // we collect signUp data
    $userNames =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userNames']));
    $uniQuery = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniQuery']));
    $userTel = mysqli_real_escape_string($serverConn, stripcslashes($_POST['userTel']));
    $userMail = mysqli_real_escape_string($serverConn, stripcslashes($_POST['userMail']));
    //  FOr the password, we make sure to hash it here
    $userPass = password_hash(mysqli_real_escape_string($serverConn, stripcslashes($_POST['userPass'])), PASSWORD_DEFAULT);

    // To verify the password, we use password_verify(pass, hashedpass) which is of type bool

    // First we make the connection to the database
    // We know the database name is the inst name so we pass that into the connect statement
    $authConn = new mysqli($serverName, $username, $password, $uniQuery );

      if($authConn){

        // we then check if an existing user is in the database
        $checkUser = $authConn->prepare("SELECT * FROM auth_table WHERE userMail =?");
        $checkUser->bind_param("s",$userMail);
        $checkUser->execute();
        $checkRes = $checkUser->get_result();
        $checkRow = $checkRes->fetch_assoc();


        if ($checkRow) {
          // If the check is true
          mysqli_close($authConn);

          ?>
            <script type="text/javascript">
              alert("The user with the email you gave is already registered. Log in instead");
            </script>
          <?php

          header('Location: ../../getStarted.php');
        }
        else{
          $role = "Student";

          // If connection to database is successful, we'll insert the data here
          $insertCreate = $authConn->prepare("INSERT INTO auth_table (userNames, userMail, userTel, userPass, userRole) VALUES (?,?,?,?,?)");
          $insertCreate->bind_param("sssss",$userNames,$userMail,$userTel,$userPass,$role);
          $insertCreate->execute();


          $_SESSION['userMail'] = $userMail;
          $_SESSION['uniQuery'] = $uniQuery;
          mysqli_close($authConn);

          header('Location: ../../app/chat.php');



        }


      }
      else{
        header("Location: ../../index.html?ConnectiontoUniFailCreate");
      }




  }
  else {
    header("Location: ../../index.html?WrongAccessSignUp");
  }


 ?>
