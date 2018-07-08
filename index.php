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

  <?php
    // $sql = "SELECT id, folder_path, file_name FROM img ORDER BY id";
    // $params = array();
    // $imgs = exec_sql_query($db, $sql, $params)->fetchAll();
    // echo "reached here".$imgs;
    // display_all_pics($imgs);

    // query to display all images from database
    $sql = "SELECT id, folder_path, file_name, player_name, bio, kgs_id FROM img ORDER BY id";
    $params = array();
    $imgs = exec_sql_query($db, $sql, $params)->fetchAll();

    if (isset($imgs) and !empty($imgs)) {
        echo "<table>";
        echo "<tr>";
        $counter = 0;
        foreach($imgs as $img) {
            echo "<td>";
            $src = $img[1].$img[2];
            echo '<a href="index.php?image='.$img[0].'"><img alt="Image Upload"
                  src="'.$src.'" width="350" height="335"/></a>';
            $player_name = $img[3];
            $bio = $img[4];
            $kgs_id = $img[5];
            echo nl2br("\n".$player_name."\n".$bio);
            if (!empty($kgs_id)) {
              echo nl2br("\n Find me on KGS: ".$kgs_id);
            }
            echo "</td>";
            $counter++;
            if ($counter % 4 == 0) {
                echo "</tr>";
                echo "<tr>";
            }
        }
        echo "</table>";
    }
  ?>

</body>
<?php include("includes/footer.php");?>

</html>
