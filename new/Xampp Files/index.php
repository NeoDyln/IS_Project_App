<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!--
        Always make sure to add the below line for responsiveness
        The Viewport just selects the device's screen size
        The content="width=device-width" simply tells the browser to auto pick the device width
        The content="initial-scale=1.0" tells your browser not to zoom in on load
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inter-App</title>
    <link rel="stylesheet" href="style/index.css">

    <!-- Favicon links -->
    <link rel="apple-touch-icon" sizes="180x180" href="Images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Images/favicon-16x16.png">
    <link rel="manifest" href="Images/site.webmanifest">




    <!-- Fonts in use -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="main_bod">

        <div id="display">

          <span id="logo_pos">
            <img src="Images/android-chrome-192x192.png" id="logo" alt="Logo">
          </span>

          <span id="head_pos">
            <h1 id="bod_text">Inter-App</h1>
            <p id="bodTextAbout">Lorem ipsum dolor sit amet, </p>
          </span>

        </div>



        <div id="opts">
              <a href="getStarted.php"><button type="submit" id="getStarted">Get Started</button></a>
              <a href="register.php"><button type="submit" id="registerInst" >Register my Institution</button></a>
        </div>


    </div>


  </body>
</html>
