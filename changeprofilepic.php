<?php
include("includes/init.php");

$current_page_id="changeprofilepic";

const MAX_FILE_SIZE = 1000000;
const IMG_UPLOADS_PATH = "uploads/img/";
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Sign Up- <?php echo $title;?></title>
</head>
<body>
  <?php include("includes/header.php");
    $username = filter_input(INPUT_POST, 'user_prof', FILTER_SANITIZE_STRING);
  ?>

  <div id="content-wrap">
    <h1>Upload your new profile pic!</h1>
    <form id="uploadImage" action="changeprofilepic.php" method="post" enctype="multipart/form-data">
      <ul>
        <!-- <li> -->
          <label>Upload Image:</label>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
          <input type="file" name="upload_file" required>
        <!-- </li> -->
        <!-- <li> -->
          <input type='hidden' name='user_prof' value='<?php echo "$username";?>'/>
          <i><br><button name="submit_upload" type="submit">Upload</button></i>
        <!-- </li> -->
      </ul>
    </form>
  </div>
</body>
</html>

<?php

  if (isset($_POST["submit_upload"]) and !empty(check_login())){ // if user is logged in and wants to upload an image
      // get id of uploader
      $uploader = $username;

      $sql = "SELECT id FROM player WHERE username = '$uploader'";
      $params = array();
      $uploader_id = exec_sql_query($db, $sql, $params)->fetchAll()[0][0];

      $upload_info = $_FILES["upload_file"];
      if ($upload_info['error'] == UPLOAD_ERR_OK) {
        $upload_name = basename($upload_info["name"]);
        $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );
        $upload_path = IMG_UPLOADS_PATH;

        $upload_file_rename = "$uploader_id.png";

        $sql = "UPDATE player SET folder_path = '$upload_path', file_name = '$upload_file_rename'
          WHERE username = '$uploader'";
        $params = array();
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          if (move_uploaded_file($upload_info["tmp_name"], IMG_UPLOADS_PATH . "$uploader_id.$upload_ext")){
            array_push($messages, "Your image has been uploaded.");
            echo "<h6> Your profile pic has been updated!</h6>";
          }
        } else {
          echo "Failed to upload image.";
          array_push($messages, "Failed to upload image.");
        }
      } else {
        echo '<h6>File size too large. Please limit to 1MB or less.</h6>';
        array_push($messages, "Failed to upload image.");
      }

  }
?>
