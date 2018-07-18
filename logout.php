<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="logout";

log_out();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Log in- <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>Log Out</h1>

    <?php
      if (!$current_user) {
        echo ("<h6>Thanks for joining LetsGoConnect! You've been successfully logged out!</h6>");
      }
    ?>
  </div>

</body>

</html>
