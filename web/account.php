<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/User.php';

session_start();
if(!isset($_SESSION['user']) || !$_SESSION['user'])
{
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];


?>
<?php if(isset($_SESSION['userId'])): ?>

            <a href="home.php">Home</a>
			<a href="logout.php">Log Out</a>
<?php endif ?>			
<h1>LoggedIn User Info</h1>
 <?php if($user->getPhoto()) :?>
<img src="<?= $user->getPhoto() ?>" width="300" height="300" />
 <?php endif; ?>
<h3>Username: <?= $user->getUsername() ?></h3>
<h3>Email: <?= $user->getEmail() ?></h3>

<h3><a href="editprofile.php">Edit Profile</a></h3>
