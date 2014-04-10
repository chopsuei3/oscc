<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>CMS</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="main">
<h1>CMS</h1>
<?php
if (empty($_POST) && isset($_GET['action'])) {
		$action = $_GET['action'];
		switch ($action) {
			case 'logout':
				session_unset();
				session_destroy();
				break;
	}
}
if (!isset($_SESSION['user'])) {
	$user = '';
	$pass = '';
	if (isset($_POST['login'])) {
		$user = strtolower(trim($_POST['user']));
		$pass = $_POST['pass'];
		$errors = array();
		if ($user == '' || $user != 'admin') {
			$errors['user'] = '';
		}
		if ($pass == '' || $pass != 'n0spr1nt') {
			$errors['pass'] = '';
		}
		if (empty($errors)) {
			$_SESSION['user'] = $user;
		} else {
			echo '<p class="error">Please fill in your correct ';
			if (isset($errors['user']))
				echo 'username';
			if (count($errors) == 2)
				echo ' and ';
			if (isset($errors['pass']))
				echo 'password';
			echo '.</p>', "\n";
		}
	}
}
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
?>
<div id="headertext">
	<p class="l">You are logged in as <strong><?php echo $user?></strong>.</p>
	<p class="r"><a href="?action=logout">Logout</a></p>
</div>
<?php
	if (isset($_POST['edit'])) {
		if (file_put_contents('homecontent.txt', $_POST['homecontent']) !== FALSE)
			echo '<p class="succes">Your changes are saved.</p>', "\n";
	}
	$homecontent = file_get_contents('homecontent.txt');
?>
<form method="post" action="">
	<p>Here you can edit your homepage text:</p>
	<textarea name="homecontent" id="homecontent" rows="20" cols="55"><?php echo $homecontent?></textarea>
	<p><button type="submit" name="edit">Save changes</button></p>
</form>
<?php } else {?>
<form method="post" action="" id="login">
	<p>
		<label for="user">Username:</label><input type="text" name="user" id="user" value="<?php echo $user?>" />
	</p>
	<p>
		<label for="pass">Password:</label><input type="password" name="pass" id="pass" value="<?php echo $pass?>" />
	</p>
	<p>
		<button type="submit" name="login">Login</button>
	</p>
</form>
<?php }?>
</div>
</body>
</html>