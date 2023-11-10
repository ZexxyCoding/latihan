<?php
  require "functions.php"; 

  if (isset($_POST['register']) ) {
    
    if (registrasi($_POST) > 0) {
      echo "<script>
      alert('user baru berhasil ditambahkan!');
      </script>";
    }else{
      echo mysqli_error($conn);
    }
  }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
  <form action="" method="post">
    <div class="row">
      <h1 style="text-align:center">Registrasi User</h1>
      <div class="vl">
        <span class="vl-innertext"></span>
      </div>

<label for="username"><b>Username</b></label>
    <input type="text" placeholder="username" name="username" id="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <label for="konfirmasi"><b>konfirmasi</b></label>
    <input type="password" placeholder="Repeat Password" name="password2" id="password2" required>
    
    <button type="submit" class="registerbtn" name="register">Register</button>
	<span>Have account <a href="login.php">Sign in?</a></span>
      </div>
      
    </div>
  </form>
</div>
  <style type="text/css">
  body {
font-family: Garamond;
background-color: lavenderblush;
}
form {
	padding: 2px;
      margin: auto;
      margin-top: 100px;
      width: 700px;
}
input[type=text], input[type=password] {
width: 100%;
padding: 10px 15px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
}
button {
background-color: lightcoral;
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
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: khaki;
}
.container {
padding: 10px;
}
span.psw {
  float: right;
  padding-top: 16px;
}
</style>
</body>
</html>