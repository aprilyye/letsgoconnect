<header>
  <h1 id="title"><?php echo $title; ?></h1>

  <nav id="menu">
    <ul>
      <?php
      foreach($pages as $page_id => $page_name) {
        // utilize the current location to style it differently
        if ($page_id == $current_page_id) {
          $css_id = "id='current_page'";
        } else {
          $css_id = "id='not_current_page'";
        }
        echo "<li><a " . $css_id . " href='" . $page_id. ".php'>$page_name</a></li>";
      }
      if ($current_user) {
        echo "<h7>Logged in as $current_user</h7>";
      }
      ?>
    </ul>
    <!-- <p>
      <?php
      if ($current_user) {
        echo "Logged in as $current_user";
      }
      ?>
    </p> -->
  </nav>
</header>
