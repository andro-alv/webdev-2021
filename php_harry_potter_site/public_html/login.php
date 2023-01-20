 <?php

  // grab the username & password
  $username = $_POST['username'];
  $password = $_POST['password'];


  // make sure they entered something into both blanks
  if ($username && $password) {
    // access the 'teacheraccounts.txt' text file
    include('config.php');

    $data = file_get_contents($file_path.'/teacheraccounts.txt');
    $accounts = explode("\n",$data);
    //print_r($accounts);
    foreach($accounts as $v){
      $credentials = explode(",", $v);

      // check to make sure the username & password are correct
      if ($username == $credentials[0] && $password == $credentials[1]) {
        // login successful!

        // drop a cookie on the client computer
        setcookie('loggedin', 'yes');
        setcookie('username', $credentials[0]);
        setcookie('firstname', $credentials[2]);
        setcookie('lastname', $credentials[3]);
        $t = time();
        file_put_contents($file_path.'/adminlog.txt', $t.",".$credentials[0].","."login"."\n", FILE_APPEND);

        // send them back to the form
        header('Location: admin.php');

        exit();
      }


    }

    header('Location: admin.php?error=incorrect');
    exit();


  }
  else {
    // send them back to the form
    header('Location: admin.php?error=missinginfo');
    exit();
  }

 ?>
