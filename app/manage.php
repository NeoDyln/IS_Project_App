<?php

  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  if(session_status() === PHP_SESSION_NONE) session_start();

  require '../php/chats/chatConnector.php';
  require '../php/serverConnector.php';


  $userSt = "SELECT * FROM auth_table ORDER BY id ASC";
  $userQuery = mysqli_query($chatConn, $userSt);

  if (mysqli_num_rows($userQuery) > 0) {
    // We'll use a for loop to pull information about the users present
    $rowUser =$userQuery;
  } else {
    // Thus should be unreachable
    echo "This should be unreachable. It simply means there are no other registered users";
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
  </head>
  <body>
    <button type="submit" name="endTeam">Delete Entire Team?</button>

    <?php
      if (isset($_POST['endTeam'])) {
        $selectDB = "SELECT * FROM institutions WHERE uniAdmin = '$userMail'";
        $serverCon = mysqli_query($serverName,$username,$password,'interappconn');
        $selectQuery = $serverCon->query($selectDB);

        if ($selectQuery) {
          
        }
      }
    ?>

    <table>
      <thead>
        <tr>
          <td colspan="4"><em>Users View</em></td>
        </tr>
      </thead>
      <tbody>

          <?php
            while($rows = $rowUser->fetch_assoc()){
              ?>
            <tr>
              <td><?php echo $rows['id'];?></td>
              <td><?php echo $rows['userNames'];?></td>
              <td><?php echo $rows['userMail'];?></td>
              <td><?php echo $rows['userTel'];?></td>

            </tr>
            <?php
            }
          ?>


      </tbody>
    </table>



  </body>
</html>
