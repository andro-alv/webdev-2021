<?php

  include('config.php');

  // security audit - make sure the user is logged in before making changes!
  if ($_COOKIE['loggedin'] == 'yes') {
    // if they are logged in make changes to the text files
    $homepage = $_POST['homepage'];
    $aboutpage = $_POST["aboutpage"];
    $policiespage = $_POST["policiespage"];
    $alertpage = $_POST["alertpage"];

    // put this into the text file
    file_put_contents($file_path.'/home.txt', $homepage);
    file_put_contents($file_path.'/alert.txt', $alertpage);
    file_put_contents($file_path.'/about.txt', $aboutpage);
    file_put_contents($file_path.'/policies.txt', $policiespage);

    // send them back to the form
    header('Location: admin.php?confirmation=savedtext');
    exit();
  }
  else {
    // send them back to the admin page
    header('Location: admin.php?error=notloggedin');
    exit();
  }





 ?>
