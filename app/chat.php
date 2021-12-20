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
            <?php
              foreach($rowUser as $user){
            ?>
              <option value="<?php echo $user['userMail']; ?>"><?php echo $user['userNames']; ?></option>
            <?php
              }
            ?>
          </datalist>

          <input type="submit" id="userListSearchBtn" name="startNewChat" value="Start Chat">
        </form>

        <span id="chat">

          <!-- For each chat, we'll make a query to the database -->
          <?php
            foreach($chatRow as $row){
              // We then want to retrieve the user name of each chat
              $curRec = $row['recipient'];
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
              <form id="userchatBar" action="chatView.php" method="post">

                  <input type="hidden" name="recipient" value="<?php echo $row['recipient'];?>">
                  <input type="hidden" name="sender" value="<?php echo $_SESSION['userMail'];  ?>">
                  <input type="hidden" name="recipName" value="<?php echo $resRecNames['userNames'];?>">
                  <img src="../Images/user.png" id="userImg" alt="">
                  <p id="peerUser" name="recipName" ><?php echo $resRecNames['userNames'];  ?></p>
                  <input type="submit" id="chatBtn" name="openChat" value="Chat">


              </form>


              <?php
            }
          ?>

          <p id="noChatsMesss">You don't have other chats. Search on the search bar above to start one</p>


        </span>
      </div>
      <div id="group">
        <p id="groupIntro">Your Groups</p>

        <form id="groupSearch" action="../php/chat/newGroup.php" method="post">
          <input type="search" id="groupList" name="newGroupName" placeholder="Find a group">
          <datalist id="userList">
            <option value=""></option>
          </datalist>
          <input type="submit" id="groupListBtn" name="joinNewGroup" value="Join Group">
        </form>


        <span id="group_list">
          <span id="groupchatBar">
            <img src="../Images/group.png" id="groupImg" alt="">
            <p id="groupName">GroupName</p>
            <p id="lastGChat">Last Chat</p>
          </span>
        </span>

      </div>
    </div>




    </script>
  </body>
</html>
