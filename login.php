<?php

require 'functions.php';


if(isset($_POST["login"])){

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	//cek username
	if(mysqli_num_rows($result) === 1){

		//cek password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])){

			//set session
			$_SESSION["login"] = true;

			//cek remember me
			if(isset($_POST['remember'])){
				//buat cookie
				setcookie('login', 'true', time()+60);
			}



			header("Location: index.php");
			exit;
		}
	}

			$error = true;
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    body {
      font-family: Garamond;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      text-transform: uppercase;
      border-bottom: 4px red;
    }

    .container {
      padding: 20px 20px;
    }

    .row {
      width: 350px;
      background: pink;
      /*meletakkan form ke tengah*/
      margin: 30px auto;
      padding: 10px 50px;
      border-radius: 30px;
    }

    form {
      padding: 2px;
      margin: auto;
      margin-top: 100px;
      width: 700px;
    }

    input[type=text],
    input[type=password] {
      width: calc(100% - 20px);
      padding: 8px 10px;
      margin-bottom: 15px;
      border: none;
      background-color: transparent;
      border-bottom: 2px solid #FF1493;
      font-size: 20px;

    }

    button {
      background-color: #FF1493;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <div class="row">
        <h2>Login</h2>
        <label for="uname"><b>Username</b></label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
		<span>Don't have account <a href="registrasi.php">Register?</a></span>
        <br>
      </div>
  </div>
</body>

</html>