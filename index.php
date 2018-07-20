<?php
    include('includes/init.php');
    // declare the current location, utilized in header.php
    $current_page_id="index";
    // set max file size
    const MAX_FILE_SIZE = 1000000;
    const IMG_UPLOADS_PATH = "uploads/img/";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

    <title>Home - <?php echo $title;?></title>
</head>

<body>
  <?php
    include("includes/header.php");
  ?>
  <h1> Let's Go Connect </h1>

  <?php
    $selected_img = "";
    $selected_img = filter_input(INPUT_GET, "image", FILTER_SANITIZE_STRING);
    if ($selected_img > 0) {
      display_selected_img($selected_img, $db);
    } else {
      display_all_img($db);
    }


    function display_selected_img ($selected_img, $db) {

      $sql = "SELECT id, folder_path, file_name, first_name, last_name, bio,
        ranking, kgs_id, tygem_id, igs_id, username FROM player WHERE id = ".$selected_img;
      $params = array();
      $user_info = exec_sql_query($db, $sql, $params)->fetchAll();
      if (isset($user_info) and !empty($user_info)) {
          $details = $user_info[0];
          $src = $details[1].$details[2];
          $first_name = $details[3];
          $name = $first_name." ".$details[4];
          $bio = $details[5];
          $ranking = $details[6];
          $kgs_id = $details[7];
          $tygem_id = $details[8];
          $igs_id = $details[9];
          echo '<img id="imgopen" alt="Image Upload" src="'.$src.'" width="350" height="350"/>';
          echo "<h3> ...with $name!</h3>";
          echo "<h5>";
          echo "A little about $first_name: $bio<br>";
          echo "Current rank: $ranking<br>";
          echo "Find $first_name on: ";
          if (!empty($kgs_id)) {
            echo "KGS as $kgs_id<br>";
          } if (!empty($igs_id)) {
            echo "IGS as $igs_id<br>";
          } if (!empty($tygem_id)) {
            echo "Tygem as $tygem_id<br>";
          } else {
            echo "No Go servers at the moment<br>";
          }
          echo "</h5>";

          // if user is logged in, can view other players' email addresses
          if (!empty(check_login())) {
            $username = $details[10];
            echo "<h5>Contact $first_name at $username</h5>";

            // check if selected profile is logged in user himself
            // echo '<form>';
            $cur_user = check_login();
            $admin = 'aaronyyye@gmail.com';
            if ($username == $cur_user || $cur_user == $admin) {
              ?>
              <div class="button-container">
                <form action="/changeprofilepic.php" method="post">
                  <input type='hidden' name='user_prof' value='<?php echo "$username";?>'/>
                  <button name="upload_image" type="submit">Change Profile Picture</button>
                </form>
                <form action="/editprofile.php" method="post">
                  <input type='hidden' name='user_prof' value='<?php echo "$username";?>'/>
                  <button name="edit_profile" type="submit">Edit Profile</button>
                </form>
              </div>
              <?php
            }
          }
      }
    }

    function display_all_img ($db) {
      // query to display all images from database
      $sql = "SELECT id, folder_path, file_name, first_name, last_name, bio,
        kgs_id, tygem_id, igs_id FROM player ORDER BY id";
      $params = array();
      $imgs = exec_sql_query($db, $sql, $params)->fetchAll();

      $sql = "SELECT COUNT(*) FROM player";
      $params = array();
      $total_players = (exec_sql_query($db, $sql, $params)->fetchAll())[0][0];

      echo "<h2> ...with $total_players other players in the world!</h2>";

      if (isset($imgs) and !empty($imgs)) {
          echo "<table>";
          echo "<tr>";
          $counter = 0;
          foreach($imgs as $img) {
              echo "<td>";
              if ($img[1].$img[2] !== '') {
                $src = $img[1].$img[2];
              } else {
                $src = 'uploads/img/emptypic.png';
              }
              echo '<a href="index.php?image='.$img[0].'"><img alt="Image Upload"
                    src="'.$src.'" width="350" height="335"/></a>';
              $first_name = $img[3];
              $last_name = $img[4];
              $bio = $img[5];
              $kgs_id = $img[6];
              $tygem_id = $img[7];
              $igs_id = $img[8];

              echo nl2br("\n"."<h6>$first_name $last_name"."\n A litle about me: ".$bio);
              if (!empty($kgs_id)) {
                echo nl2br("\n Find me on KGS: ".$kgs_id);
              } if (!empty($tygem_id)) {
                echo nl2br("\n Find me on Tygem: ".$tygem_id);
              } if (!empty($igs_id)) {
                echo nl2br("\n Find me on IGS: ".$igs_id);
              }
              echo "</h6></td>";
              $counter++;
              if ($counter % 4 == 0) {
                  echo "</tr>";
                  echo "<tr>";
              }
          }
          echo "</table>";
      }
    }

  ?>

</body>
<!-- <?php include("includes/footer.php");?> -->

</html>
