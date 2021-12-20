<?php
  if(session_status() == PHP_SESSION_ACTIVE) session_destroy();
  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  if(session_status() === PHP_SESSION_NONE) session_start();
  require 'php/serverConnector.php';
  require 'php/TeamChecker.php';


?>
  <!--DOCTYPE html-->
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">

        <!--  Always make sure to add the below line to make responsiveness -->
        <!--  The Viewport just selects the device's screen size -->
        <!--  The content="width=device-width" simply tells the browser to auto pick the device width -->
        <!--  The content="initial-scale=1.0" tells your browser not to zoom in on load -->

      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Inter-App</title>

      <link rel="stylesheet" href="style/auth.css">
      <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon-32x32.png">



    </head>
    <body>
      <div class="main_bod">

        <div id="display">

          <span id="logo_pos">
            <img src="Images/android-chrome-192x192.png" id="logo" alt="Logo">
          </span>

          <span id="head_pos">
            <h1 id="bod_text">Let's get started</h1>
          </span>




            <span id="defaultView">
              <h2>What would you like to do? </h2>
              <h5>All new/ first time users need to create an account</h5>

              <button type="button" class="defBtn" id="logInBtn" name="logIn" onclick="logIn()">Log In</button><br>
              <button type="button"  class="defBtn" id="signUpBtn" name="Sign Up" onclick="signUp()">Create an account</button><br>
              <button type="button" class="defBtn" id="resetPassBtn" name="resetPass" onclick="resetPass()">Reset my Password</button><br>
            </span>


            <!--
            Below here are the various forms to which the buttons above link to.
            Each will cause everything else to display none.
          -->

            <form id="Uni_Login_Form" action="php/auth/login.php" method="post">
              <h2 class="auth_form_message">Let's get you logged in</h2><br>

              <label for="uniQuery">Search for your institution below</label><br><br>
              <input type="search" name="uniQuery" list="uniList" placeholder="Type in your university here ..." required> <br><br>
              <!--
                  Here, we will simply query the database for whether the institution being searched exists
                  We will pull the institutions into a list below and assign each opption as an option that's selectable
              -->
              <datalist id="uniList">
                <?php
                  foreach ($row as $item) {

                      ?>
                      <option value="<?php echo $item['uniInit']; ?>"><?php echo $item['uniName'];  ?> </option>
                      <?php
                    }
                ?>
              </datalist>

              <h5 class="auth_form_error">If you cannot find it, your institution currently isn't registered or has been deregistered from our system. Ask your Administartor or try again later</h5><br>

              <input type="hidden" name="uniDB"><!-- This will collect the user's university database code -->
              <input type="hidden" name="uniSelMess">

              <input type="email" name="userMail" placeholder="Email Address" required> <br><br>

              <input type="password" name="userPass" placeholder="Password" required> <br>

              <input type="submit" name="logOn" value="Log In">






            </form>

            <form id="Uni_Create_Form" action="php/auth/create.php" method="post">
              <h2 class="auth_form_message_create">Create Account</h2>

              <label for="uniQuery">Search for your institution below</label>
              <input type="search" name="uniQuery" list="uniList" placeholder="Type in your university here ..." required> <br><br>
              <!--
                  Here, we will simply query the database for whether the institution being searched exists
                  We will pull the institutions into a list below and assign each opption as an option that's selectable
              -->
              <datalist id="uniList">
                <?php
                  foreach ($row as $item) {

                      ?>
                      <option value="<?php echo $item['uniInit']; ?>"><?php echo $item['uniName'];  ?> </option>
                      <?php
                    }
                ?>
              </datalist>

              <h5>Can't find it? Then your institution isn't registered or has been deregistered. Ask your administrator</h5>

              <input type="hidden" name="uniDB"><!-- This will collect the user's university database code -->

              <label for="userNames">Enter your full name</label>
              <input type="text" name="userNames" placeholder="Name(s)..." required data-emojiable="true"> <br><br>

              <label for="userTel">Enter your phone number</label>
              <input type="tel" name="userTel" placeholder="Phone number..." required> <br><br>

              <label for="userMail">Enter your institution email</label>
              <input type="email" name="userMail" placeholder="Email Address" required> <br><br>

              <label for="userPass">Enter your Password</label>
              <input type="password" name="userPass" placeholder="Password" required> <br><br>

              <label for="userPassR">Confirm your Password</label>
              <input type="password" name="userPassR" placeholder="Repeat Password" required> <br>

              <input type="submit" name="signUp" value="Create Account">



              <input type="hidden" name="uniSelMess">



            </form>

            <form id="Uni_Reset_Form" action="php/auth/reset.php" method="post">
              <h2 class="auth_form_message">Reset your Password</h2><br>

              <input type="search" name="uniQuery" list="uniList" placeholder="Type in your university here ..." required> <br><br>
              <!--
                  Here, we will simply query the database for whether the institution being searched exists
                  We will pull the institutions into a list below and assign each opption as an option that's selectable
              -->
              <datalist id="uniList" >
                <!--  For each uni in the database, we shall list them here as an option -->
                <option value="<Uni Name>"></option>

              </datalist>

              <input type="hidden" name="uniDB"><!-- This will collect the user's university database code -->


              <input type="email" name="userMail" placeholder="Enter your registered Email-Address" required data-emojiable="true"> <br><br>

              <input type="submit" name="resetReq" value="Reset my Password">




            </form>












        </div>



        <div id="footer">
              <a href="index.html"><button type="submit" id="auth_back_btn">Back to Home Page</button></a>
        </div>



      </div>

      <!-- Local Scripts -->
      <script type="text/javascript" src="scripts/auth.js">




      <!-- Scripts for Emojis -->
      <script src="emojis/scripts/config.js"></script>
      <script src="emojis/scripts/util.js"></script>
      <script src="emojis/scripts/jquery.emojiarea.js"></script>
      <script src="emojis/scripts/emoji-picker.js"></script>

      </script>
    </body>
  </html>
