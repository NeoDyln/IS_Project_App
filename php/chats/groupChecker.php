<?php

  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  if(session_status() === PHP_SESSION_NONE) session_start();

  require 'chatConnector.php';



  $searchSql = "SELECT groupname, creator FROM groups";
  $searchQuery = mysqli_query($chatConn, $searchSql);

  if ($searchQuery) {
    // We'll use a for loop to pull information about the users present
  } else {
    // Thus should be unreachable
    ?>
      <script type="text/javascript">
        alert("Currently no groups exist");
      </script>
    <?php
  }

?>
