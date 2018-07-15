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

    // query to display all images from database
    $sql = "SELECT id, folder_path, file_name, first_name, last_name, bio,
      kgs_id, tygem_id, igs_id FROM player ORDER BY id";
    $params = array();
    $imgs = exec_sql_query($db, $sql, $params)->fetchAll();

    $sql = "SELECT COUNT(*) FROM player";
    $params = array();
    $total_players = (exec_sql_query($db, $sql, $params)->fetchAll())[0][0];

    echo "<h2> Connect with $total_players other players in the world!</h2>";

    if (isset($imgs) and !empty($imgs)) {
        echo "<table>";
        echo "<tr>";
        $counter = 0;
        foreach($imgs as $img) {
            echo "<td>";
            $src = $img[1].$img[2];
            echo '<a href="index.php?image='.$img[0].'"><img alt="Image Upload"
                  src="'.$src.'" width="350" height="335"/></a>';
            $first_name = $img[3];
            $last_name = $img[4];
            $bio = $img[5];
            $kgs_id = $img[6];
            $tygem_id = $img[7];
            $igs_id = $img[8];

            echo nl2br("\n"."$first_name $last_name"."\n".$bio);
            if (!empty($kgs_id)) {
              echo nl2br("\n Find me on KGS: ".$kgs_id);
            } if (!empty($tygem_id)) {
              echo nl2br("\n Find me on Tygem: ".$tygem_id);
            } if (!empty($igs_id)) {
              echo nl2br("\n Find me on IGS: ".$igs_id);
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
