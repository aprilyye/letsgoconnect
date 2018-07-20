<?php
include("includes/init.php");

$current_page_id="signupsucccess";
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
    <h1>You've successfully signed up!</h1>
  </div>
</body>
</html>
<?php
  if (isset($_POST['signup'])) {
    $user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $user = trim($user);
    $pswd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);
    sign_up($user, $hashed_pswd, $db);
  }

  function sign_up($user, $pswd, $db) {
    if ($user && $pswd) {
      try {
        // get other fields from signup form
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
        $ranking = filter_input(INPUT_POST, 'ranking', FILTER_SANITIZE_STRING);
        $kgs_id = filter_input(INPUT_POST, 'kgs_id', FILTER_SANITIZE_STRING);
        $tygem_id = filter_input(INPUT_POST, 'tygem_id', FILTER_SANITIZE_STRING);
        $igs_id = filter_input(INPUT_POST, 'igs_id', FILTER_SANITIZE_STRING);

        // dummy field for pic
        $folder_path = 'uploads/img/';
        $file_name = 'emptypic.png';
        // insert fields into db

        $sql = "INSERT INTO player (username, password, first_name, last_name,
          bio, ranking, kgs_id, tygem_id, igs_id, folder_path, file_name)
          VALUES (:username, :password, :first_name, :last_name, :bio, :ranking,
            :kgs_id, :tygem_id, :igs_id, :folder_path, :file_name)";

        $params = array(
          ':username' => $user,
          ':password' => $pswd,
          ':first_name' => $first_name,
          ':last_name' => $last_name,
          ':bio' => $bio,
          ':ranking' => $ranking,
          ':kgs_id' => $kgs_id,
          ':tygem_id' => $tygem_id,
          ':igs_id' => $igs_id,
          ':folder_path' => $folder_path,
          ':file_name' => $file_name
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          echo("<h6>Welcome, $user! You've successfully become a part of the community</h6>");
        }

      } catch (Exception $e) {
        record_message("Could not register user.");
      }
    } else {
      record_message("No username or password given.");
    }
  }
?>
