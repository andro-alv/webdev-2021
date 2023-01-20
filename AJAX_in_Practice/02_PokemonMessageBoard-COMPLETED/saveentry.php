<?php

  // file path
  $path = getcwd() . '/data';

  // grab the incoming data
  $text = $_POST['message'];
  $img = $_POST['avatar'];

  // make sure we have both values
  if ($text && $img) {

    // construct a unique ID for this entry
    $id = uniqid();

    // construct a string to store
    $data_to_store = $id . '|' . $img . '|' . $text . "\n";

    // save to a file
    file_put_contents($path.'/data.txt', $data_to_store, FILE_APPEND);
    print ($id);
    exit();
  }

  print ("ERROR");
  exit();

 ?>
