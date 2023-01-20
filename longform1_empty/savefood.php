<?php
include('config.php');
$text = $_POST["Fruit"];
$text = strtolower($text);
file_put_contents($file_path."/votes.txt", $text.'\n', FILE_APPEND);
exit();

 ?>
