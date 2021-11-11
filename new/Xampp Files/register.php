<?php
session_start();

 ?>
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


      <form class="uniChecker" action="php/CheckUni.php" method="post">
        <label for="UniSearch">First, try and find your organization below</label>
        <input type="search" name="UniSearch" list="UniList" placeholder="Type here">
        <datalist class="UniList">
          <?php
          while ($row) {
            ?>

            <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?> </option>

            <?php
          }
          ?>
        </datalist>
      </form>

      <p id="UniMissErr">If you cannot find it here, then you can safely proceed to register below</p>

      <form class="registration" action="php/CreateUni.php" method="post">

      </form>

      <div class="footBtns">
        <a href="index.php"> <button type="button" id="backButton" name="backButton">Go back</button> </a>
        <a href="#"><button type="button" id="regButton" name="regButton">Register</button></a>
      </div>



    </body>
  </html>
