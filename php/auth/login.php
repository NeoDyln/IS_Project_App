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
        $logIn = $authConn->prepare("SELECT * FROM auth_table WHERE userMail = ?");
        $logIn->bind_param('s',$userMail);
        $logIn->execute();
        $logInQuery = $logIn->get_result();


        // Check if there's any data. If no data is there, check will be false
        if (!$logInQuery) {
          // Return an error message
          ?>
            <script type="text/javascript">
              alert("User with that mail does not exist");
            </script>
          <?php
          header('Location: ../../getStarted.php');
        }
        else {
          // We collect the info
          $logInRes = $logInQuery->fetch_assoc();


          // Now we cross check the pasword by hashing the password password_verify which returns true if true
          $passWordTest = password_verify($userPass,$logInRes['userPass']);

          if ($passWordTest == FALSE) {

            // Return a wrong password error
            ?>
              <script type="text/javascript">
                alert("Incorrect Password");
              </script>
            <?php
            header('Location: ../../getStarted.php');


          }
          else {
            // Log In success....Pass in user Mail and redirect to chat.php
            mysqli_close($authConn);
            ?>
              <script type="text/javascript">
                alert("Log in was successful");
              </script>
            <?php

            // At this point,, the user has successfully logged in
            $_SESSION['userMail'] = $userMail;
            $_SESSION['uniQuery'] = $uniQuery;
            header('Location: ../../app/chat.php');
            // echo $_SESSION['userMail'];
            // header('Location: ../../index.html');

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
