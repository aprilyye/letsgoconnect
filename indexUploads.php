<!-- <?php
  include("includes/init.php");
?> -->
<?php
  function display_all_pics($query_imgs) {
    // $sql = "SELECT id, folder_path, file_name FROM img ORDER BY id";
    // $params = array();
    // $query_imgs = exec_sql_query($db, $sql, $params)->fetchAll();
    if (isset($query_imgs) and !empty($query_imgs)) {
        echo "<table>";
        echo "<tr>";
        $counter = 0;
        foreach($query_imgs as $img) {
            echo "<td>";
            $src = $img[1].$img[2];
            echo '<a href="index.php?image='.$img[0].'"><img alt="Image Upload" src="'.$src.'" width="300" height="335"/></a>';

            echo "</td>";
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
