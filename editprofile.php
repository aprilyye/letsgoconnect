<?php
include("includes/init.php");

$current_page_id="editprofile";
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Sign Up- <?php echo $title;?></title>
</head>
<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>Update your profile!</h1>
    <form id="signupform" action="/editsuccess.php" method="post">
      <ul>
          <p>
          <label>Bio:</label>
          <textarea rows="4" cols ="50" name="bio" form="signupform"> </textarea><br>
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
            $username = filter_input(INPUT_POST, 'user_prof', FILTER_SANITIZE_STRING);
          ?>
          <label>Kgs ID:</label>
          <input type="text" name="kgs_id"/> <br>
          <label>Tygem ID:</label>
          <input type="text" name="tygem_id"/> <br>
          <label>IGS ID (Panda Net):</label>
          <input type="text" name="igs_id"/> <br>
          <input type='hidden' name='user_prof' value='<?php echo "$username";?>'/>
          <br><button name="submit_edit" type="submit">Save Edits</button>
        </p>
      </ul>
    </form>
  </div>
</body>
</html>
