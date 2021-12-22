<?php

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

$userMail = $_SESSION['userMail'];
$uniQuery = $_SESSION['uniQuery'];

require '../php/chats/dueDiligence.php';
require '../php/chats/userSearch.php';
require '../php/chats/groupChecker.php';
require '../php/chats/pullChatsUsers.php';
require '../php/chats/newChat.php';

if (isset($_POST['logOut'])) {
  session_destroy();

  ?>
    <script type="text/javascript">
      alert("Log out successful");
    </script>
  <?php
  session_destroy();
  header('Location: ../index.html');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat View</title>
    <link rel="stylesheet" href="../style/chat.css">
    <!-- Fonts in use -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="header">
      <h2 id="introtext">Welcome <?php echo $uniQuery ?></h2>
      <p id="userName"><?php echo $row['userNames']; ?></p>
      <form class="logOff" action="#" method="post">
        <button type="submit" id="logOff" name="logOut">Log Out</button>
      </form>

    </div>
    <div id="chats">
      <div id="peer">
        <p id="peerIntro">Your Chats</p>
        <form id="userSearch" action="#" method="post">
          <input type="search" id="userList" list="uniListed"  name="newChatMail" placeholder="Find a user">
          <datalist id="uniListed">
            <!-- We'll use a search function to look through database -->
            <?php
            // Logic for user search
                if(session_status() !== PHP_SESSION_ACTIVE) session_start();
                if(session_status() === PHP_SESSION_NONE) session_start();

                require '../php/chats/chatConnector.php';

                $userSt = "SELECT * FROM auth_table";
                $userQuery = $chatConn->query($userSt);

                if (mysqli_num_rows($userQuery) > 0) {
                  // We'll use a for loop to pull information about the users present
                    while($rowUsers = $userQuery->fetch_assoc()){
                    ?>
                      <option value="<?php echo $rowUsers['userMail']; ?>"><?php echo $rowUsers['userNames']; ?></option>
                    <?php
                    }
                }
                else {
                  // Thus should be unreachable
                  ?>
                    <option value="<?php echo "No other users"; ?>"><?php echo "No Other Users Registered"; ?></option>
                  <?php
                }

            ?>
          </datalist>

          <input type="submit" id="userListSearchBtn" name="startNewChat" value="Start Chat">
        </form>

        <span id="chat">

          <!-- For each chat, we'll make a query to the database -->
          <?php

              // Retrieve Chats Logic
                  // Establish a connection to the database by importing serverconnector
                  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
                  if(session_status() === PHP_SESSION_NONE) session_start();

                  require '../php/chats/chatConnector.php';

                  // We select all existing chats where the logged in user has chatted

                  $sender = $_SESSION['userMail'];

                  $select = "SELECT * FROM chats WHERE (sender='$sender') OR (recipient='$sender')";
                  $selectQuery = $chatConn->query($select);

                  // This array will track our list of users
                  $recip = array();
                while($chatRows = $selectQuery->fetch_assoc()){
                    if (in_array($chatRows['sender'],$recip) || in_array($chatRows['recipient'],$recip)) {
                      // If a user chat has been listed, we ignore it
                    }

                    else{
                      // We then want to retrieve the user name of each chat
                      if (($chatRows['sender'] !== $userMail) && (!in_array($chatRows['sender'],$recip))) {
                        $curRec = $chatRows['sender'];
                        array_push($recip, $curRec);
                      }
                      else if(($chatRows['sender'] == $userMail) && (!in_array($chatRows['recipient'],$recip))){
                        $curRec = $chatRows['recipient'];
                        array_push($recip, $curRec);
                      }

                      $recName = $chatConn->prepare("SELECT * FROM auth_table WHERE userMail = ? ");
                      $recName->bind_param('s',$curRec);
                      $recName->execute();
                      $resRecName = $recName->get_result();
                      $resRecNames = $resRecName->fetch_assoc();

                      if (!$resRecNames) {
                        ?>
                          <script type="text/javascript">
                            alert("Failed to retrieve userName");
                          </script>
                        <?php
                      }
                      ?>
                      <form id="userchatBar" action="../php/chats/openChat.php" method="post">

                          <input type="hidden" name="recipient" value="<?php echo $chatRows['recipient'];?>">
                          <input type="hidden" name="sender" value="<?php echo $_SESSION['userMail'];  ?>">
                          <input type="hidden" name="recipName" value="<?php echo $resRecNames['userNames'];?>">
                          <img src="../Images/user.png" id="userImg" alt="">
                          <p id="peerUser" name="recipName" ><?php echo $resRecNames['userNames'];  ?></p>
                          <input type="submit" id="chatBtn" name="openChat" value="Chat">




                      </form>


                      <?php
                    }



                }

          ?>

          <p id="noChatsMesss">You don't have other chats. Search on the search bar above to start one</p>


        </span>
      </div>
      <div id="group">
        <p id="groupIntro">Your Groups</p>

        <form id="groupSearch" action="../php/chat/newGroup.php" method="post">
          <input type="search" id="groupList" name="newGroupName" placeholder="Find a group">
          <datalist id="groupList">
            <?php
            // Logic for user search
                if(session_status() !== PHP_SESSION_ACTIVE) session_start();
                if(session_status() === PHP_SESSION_NONE) session_start();

                require '../php/chats/chatConnector.php';

                $userSt = "SELECT * FROM groupchats WHERE id = 1";
                $userQuery = $chatConn->query($userSt);
                $groupName = "";

                if (mysqli_num_rows($userQuery) > 0) {
                  // We'll use a for loop to pull information about the users present
                    while($rows = $userQuery->fetch_assoc()){
                    ?>
                      <option value="<?php echo $rows['groupName']; ?>"><?php echo $rows['groupName']; ?></option>
                    <?php
                    $groupName = $rows['groupName'];
                    }
                }
                else {
                  // Thus should be unreachable
                  ?>
                    <option value="<?php echo "No other users"; ?>"><?php echo "No Other Users Registered"; ?></option>
                  <?php
                }

            ?>
          </datalist>

          <input type="submit" id="groupListBtn" name="joinNewGroup" value="Join Group">
        </form>


        <span id="group_list">
          <form id="groupchatBar" action="../php/chats/openGroup.php" method="post">


              <input type="hidden" name="sender" value="<?php echo $_SESSION['userMail'];  ?>">
              <input type="hidden" name="groupName" value="<?php echo $groupName;  ?>">
              <img src="../Images/group.png" id="groupImg" alt="">
              <p id="groupName" name="groupName" ><?php echo $groupName;  ?></p>
              <input type="submit" id="chatBtn" name="openGroup" value="Chat">

          </form>
        </span>



      <!-- </div> -->
    </div>




    </script>
  </body>
</html>
