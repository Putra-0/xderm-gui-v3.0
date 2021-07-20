<?php
session_start();
$show="home";
exec('grep user /root/auth.txt |awk -F"=" \'{print $2}\'',$user);
exec('grep passwd /root/auth.txt |awk -F"=" \'{print $2}\'',$pass);
if ($_GET['login']) {
     if ($_POST['username'] == $user[0]
         && $_POST['password'] == $pass[0]) {
         $_SESSION['loggedin'] = 1;
         header("Location: index.php");
         exit;
     } else 
echo '<script type="text/javascript">
alert("Username atau Password salah!");
</script>';
}
echo '<!DOCTYPE html><html><head>
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="img/fav.ico">
<title>Xderm Mini Gui versi</title>
<link type="text/css" rel="stylesheet" href="css/login.css">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script></head>
<body>';
if ($show == "home"){
	echo'
<div class="stark-login">
        <div id="logo"> 
          <h1 class="nganu slide"><i> LOGIN XDERM-MINI</i></h1>
        </div> 
        <form action="?login=1" method="post">	
          <div id="fade-box">
                <input type="text" name="username" placeholder="Username" autocomplete="off" />
                <input type="password"  name="password" placeholder="Password" />
                
                <button type="submit" value="Login">Log In</button>
              </div>
            </form>
	<footer class="nganu slide">
	<div  style="font-size: 16px; margin-top:15px; animation: logo-entry 3s ease-in;">
	Xderm GUI V.3.0  <br>Â© Design by ADI-PUTRA <br>Copyright Â© Ryan Fauzi
	</div> 
	</footer>
	</div>
';
}
    session_unset();
    session_destroy();
?>
