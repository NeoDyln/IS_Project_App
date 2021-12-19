<?php

    // Establish a connection to the database by importing serverconnector
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    if(session_status() === PHP_SESSION_NONE) session_start();

    include '../serverConnector.php';

    // Check if login algo was accessed correctly
    if (isset($_POST['logOn'])) {
      //We collect log in data
      $uniQuery = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniQuery']));
      $userMail = mysqli_real_escape_string($serverConn, stripcslashes($_POST['userMail']));
      $userPass = mysqli_real_escape_string($serverConn, stripcslashes($_POST['userPass']));


      //  We then connect to the instutution database
      // We know the database name is the inst name so we pass that into the connect statement
      $authConn = new mysqli($serverName, $username, $password, $uniQuery );

      // Test the database connection
      if ($authConn) {


        // Get data from table for log in assosciated with provided mail
        $logIn = "SELECT * FROM auth_table WHERE userMail = '$userMail'";
        $logInQuery = mysqli_query($authConn, $logIn);


        // Check if there's any data. If no data is there, check will be false
        if ($logInQuery == FALSE ) {
          // Return an error message
          mysqli_close($authConn);
          header('Location: ../../getStarted.php?NoUserExists');
        }
        else {
          // We collect the info
          $logInRes = mysqli_fetch_array($logInQuery);


          // Now we cross check the pasword by hashing the password password_verify which returns true if true
          $passWordTest = password_verify($userPass,$logInRes['userPass']);

          if ($passWordTest == FALSE) {

            // Return a wrong password error
            mysqli_close($authConn);
            header('Location: ../../getStarted.php?WrongPassword'.$logInRes['userPass'].'');


          }
          else {
            // Log In success....Pass in user Mail and redirect to chat.php
            $_SESSION['userMail'] = $userMail;
            $_SESSION['uniQuery'] = $uniQuery;
            mysqli_close($authConn);
            echo "Success Login";
            header('Location: ../../app/chat.php');
          }



        }


      }

      else {
        // code...
      }

    }
    else {
      header("Location: .././index.html?LogInWrongAccess");
    }
?>
