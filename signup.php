<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="signup";
const MAX_FILE_SIZE = 1000000;
const IMG_UPLOADS_PATH = "uploads/img/";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Sign Up- <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>Log in or sign up to become part of the community</h1>

    <form id="signupform" action="/signupsuccess.php" method="post">
      <ul>
          <p>
          <label>Email (your email will be your username):</label>
          <input type="email" name="username" required/> <br>
          <label>Password:</label>
          <input type="password" name="password" required/> <br>
          <label>First Name:</label>
          <input type="text" name="first_name" required/>
          <label>Last Name:</label>
          <input type="text" name="last_name" required/> <br>
          <label>Bio:</label>
          <textarea rows="8" cols ="50" name="bio" form="signupform"> </textarea><br>
          <label>Rank:</label>
          <?php
            $ranks=array();
            for ($x = 9; $x >= 1; $x--) {
              $ranks[] = "$x Dan Pro";
            }
            for ($x = 9; $x >= 1; $x--) {
              $ranks[] = "$x Dan";
            }
            for ($x = 1; $x <= 30; $x++) {
              $ranks[] = "$x Kyu";
            }
            echo "<select name='ranking'>";
            foreach ($ranks as $rank) {
              if ($rank == "30 Kyu") {
                echo "<option name='ranking' value='$rank' selected='selected'>$rank</option>";
              } else {
                echo "<option name='ranking' value='$rank'>$rank</option>";
              }
            }
            echo"</select><br>";
          ?>
          <label>Kgs ID:</label>
          <input type="text" name="kgs_id"/> <br>
          <label>Tygem ID:</label>
          <input type="text" name="tygem_id"/> <br>
          <label>IGS ID (Panda Net):</label>
          <input type="text" name="igs_id"/> <br>
          <br><button name="signup" type="submit">Sign Up</button>
        </p>
      </ul>
    </form>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
