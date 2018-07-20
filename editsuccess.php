<?php
include("includes/init.php");

$current_page_id="editsuccess";
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
    <h1>You've successfully edited your profile!</h1>
  </div>
</body>
</html>
<?php
  if (isset($_POST['submit_edit']) && !empty(check_login())) {
    $cur_user = check_login();
    $username = filter_input(INPUT_POST, 'user_prof', FILTER_SANITIZE_STRING);
    edit_prof($cur_user, $db, $username);
  }

  function edit_prof($user, $db, $user_prof) {
    if ($user) {
      try {
        // get other fields from signup form
        $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
        $ranking = filter_input(INPUT_POST, 'ranking', FILTER_SANITIZE_STRING);
        $kgs_id = filter_input(INPUT_POST, 'kgs_id', FILTER_SANITIZE_STRING);
        $tygem_id = filter_input(INPUT_POST, 'tygem_id', FILTER_SANITIZE_STRING);
        $igs_id = filter_input(INPUT_POST, 'igs_id', FILTER_SANITIZE_STRING);

        // insert fields into db

        $sql = "UPDATE player SET bio = ifnull('$bio', bio), ranking = ifnull('$ranking', ranking),
          kgs_id = ifnull('$kgs_id', kgs_id), tygem_id = ifnull('$tygem_id', tygem_id),
          igs_id = ifnull('$igs_id', igs_id)
          WHERE username = '$user_prof'";

        $params = array();
        $result = exec_sql_query($db, $sql, $params);

      } catch (Exception $e) {
        record_message("Could not edit profile.");
      }
    } else {
      record_message("No username or password given.");
    }
  }
?>
