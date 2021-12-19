<?php


  // Establish a connection to the database by importing serverconnector
  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  if(session_status() === PHP_SESSION_NONE) session_start();



  include '../serverConnector.php';


    if (isset($_POST['resetReq'])){

      $uniQuery = $_POST['uniQuery'];
      $userMail = $_POST['userMail'];
      //  We then connect to the instutution database
      // We know the database name is the inst name so we pass that into the connect statement
      $authConn = new mysqli($serverName, $username, $password, $uniQuery );



      // We'll collect the new reset request data
      $uniQuery = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniQuery']));
      $userMail = mysqli_real_escape_string($serverConn, stripcslashes($_POST['userMail']));



      // Test the database connection
      if ($authConn) {
        // We check if there's a record with the given user mail

        // we then check if an existing user is in the database
        $checkUser = $authConn->prepare("SELECT * FROM auth_table WHERE userMail =?");
        $checkUser->bind_param("s",$userMail);
        $checkUser->execute();
        $checkRes = $checkUser->get_result();
        $checkRow = $checkRes->fetch_assoc();



        // Check if there's any data. If no data is there, check will be false
        if ($checkRow) {

          // First we want to create/ check if a token table EXISTS for the sake of sending out reset requests

          $tokenTbl = "CREATE TABLE IF NOT EXISTS  tokenreset (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, token VARCHAR(255), uniID VARCHAR(255), userTempPass VARCHAR(255), userMail VARCHAR(255) )";
          $createTokenTable = mysqli_query($authConn, $tokenTbl);

          if ($createTokenTable){
            // We'll add the new password , a random token, the uni Id and the user details to the table
            // We'll create a new temporary password and its token, set it in the token table then mail it to the user

            // Creation
            $tempPass = bin2hex(random_bytes(30));
            $tempToken = bin2hex(random_bytes(40));



            // Setting the new temporary pass
            $updatePass = "INSERT INTO tokenreset(token, uniID, userTempPass, userMail) VALUES ('$tempToken','$uniQuery','$tempPass','$userMail')";
            $updater = mysqli_query($authConn, $updatePass);

            if ($updater) {
              // We now mail the password and token to the user and add a link to the actual reset page

              // Together with the new password, we will also mail the user database ID

              $link = "  www.$serverName/IS_Project_App/reset.php?userMail=$userMail ";

              $rec = $userMail;
              $subject = "Reset Password";
              $headers = "From: noreply@interapp.com";
              $message = "Below are the new details for your account. Use the link below them to reset your password\n Token: \t $tempToken  \n Token Password: \t $tempPass \n UniID: \t $uniQuery \n\n Copy paste and Use the link below to reset your password \n $link";

              $mailSend = mail($rec,$subject,$message,$headers);

              if ($mailSend) {
                echo "Follow instructions sent to mail";
              }

            }
            else {
              header('Location: ../../index.html?TokenInsertFail');
            }

          }




        }

        else {
          header('Location: ../../index.html?NoUserExists');
          
        }

      }
    }

?>
