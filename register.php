
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register my institution</title>

      <!-- Stylesheet link -->
      <link rel="stylesheet" href="style/reg.css">

      <!-- Fonts in use -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>


      <form class="uniChecker" action="php/TeamChecker.php" method="post">
        <h3 id="uniSearchL">First, try and find your organization below</h3>
        <input type="search" id="uniSearch" name="UniSearch" list="UniList" placeholder="Type here">
        <datalist class="UniList">
          <?php
          while ($row) {
            ?>

            <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?> </option>

            <?php
          }
          ?>
        </datalist>

        <p id="UniMissErr">If you cannot find it here, then you can safely proceed to register below</p>
        <input type="submit" id="uniQuerySubmit" onclick="showRegForm()" value="Next">
      </form>



      <form class="registration" action="php/RegisterTeam.php" method="post">
        <h3 id="RegUniFormTitle">Let's get you registered then</h3>
        <input type="text" name="uniName" id="uniname" placeholder="Enter your organization/ team name">
        <input type="text" name="uniInit" id="uniinitials" placeholder="Enter your organization's /team's initials if any">
        <input type="url" name="uniURL" placeholder="Enter your organization's/ team's URL">
        <!-- <input type="number" id="countAdmin" placeholder="How many admin emails do you wish to assosciate with this organization?"> -->
        <input type="email" name="uniAdmin" Placeholder="Enter an administrator email address">

        <input type="submit" name="registerTeam" value="Create">

      </form>

        <!-- <a href="index.php"> <button type="button" id="backButton" name="backButton">Go back</button> </a>
        <a href="#"><button type="button" id="nexButton" name="regButton">Next</button></a>
        <a href="#"><button type="button" id="nexButton" name="regButton">Next</button></a> -->



    </body>
  </html>

  <?php



  // We'll include the sever Connector as well as a code to check the registered teams and also one to check if the main database exists
  include 'php/serverConnector.php';
  include 'php/MainDatabaseCreator.php';
  include 'php/TeamChecker.php';

  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  if(session_status() === PHP_SESSION_NONE) session_start();
  $row = $_SESSION['row'];
   ?>
