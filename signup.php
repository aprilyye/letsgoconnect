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

    <form id="signupform" action="signup.php" method="post">
      <ul>
          <p>
          <label>Username:</label>
          <input type="text" name="username" required/> <br>
          <label>Password:</label>
          <input type="password" name="password" required/> <br>
          <label>Email:</label>
          <input type="email" name="email" required/> <br>
          <label>First Name:</label>
          <input type="text" name="first_name" required/>
          <label>Last Name:</label>
          <input type="text" name="last_name" required/> <br>
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

<?php
  print_messages();
  // if user clicks sign up button
  if (isset($_POST['signup'])) {
    $user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $user = trim($user);
    $pswd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    sign_up($user, $pswd, $db);
  }

  function sign_up($user, $pswd, $db) {
    if ($user && $pswd) {
      try {
        // get other fields from signup form
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
        $ranking = filter_input(INPUT_POST, 'ranking', FILTER_SANITIZE_STRING);
        $kgs_id = filter_input(INPUT_POST, 'kgs_id', FILTER_SANITIZE_STRING);
        $tygem_id = filter_input(INPUT_POST, 'tygem_id', FILTER_SANITIZE_STRING);
        $igs_id = filter_input(INPUT_POST, 'igs_id', FILTER_SANITIZE_STRING);
        // insert fields into db

        $sql = "INSERT INTO player (username, password, email, first_name, last_name, bio, ranking, kgs_id, tygem_id, igs_id)
          VALUES (:username, :password, :email, :first_name, :last_name, :bio, :ranking, :kgs_id, :tygem_id, :igs_id)";

        $params = array(
          ':username' => $user,
          ':password' => $pswd,
          ':email' => $email,
          ':first_name' => $first_name,
          ':last_name' => $last_name,
          ':bio' => $bio,
          ':ranking' => $ranking,
          ':kgs_id' => $kgs_id,
          ':tygem_id' => $tygem_id,
          ':igs_id' => $igs_id
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          echo("Welcome, $user! You've successfully become a part of the community");
        }

      } catch (Exception $e) {
        record_message("Could not register user.");
      }
    } else {
      record_message("No username or password given.");
    }
  }
?>
