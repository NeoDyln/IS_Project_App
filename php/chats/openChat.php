<?php


if (isset($_POST['openChat'])) {
  $recipient = $_POST['recipient'];
  $sender = $_POST['sender'];
}
else {
  ?>
    <script type="text/javascript">
      alert("You need to click the start chat button");
    </script>
  <?php
}



 ?>
