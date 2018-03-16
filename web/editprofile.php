<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/User.php';

session_start();
$userId = $_SESSION['userId'];

$user = new User($conn, $userId);
//$user=$_SESSION['user'];
//echo $conn;
if(!empty($_POST))
{
	  $filename = $_FILES['fileToUpload']['tmp_name'];
	  
      $filePath = '/uploads/usersImages/' . time() . '.png';
	  
     $destination = __DIR__ . $filePath;
    if(!move_uploaded_file($filename, $destination))
    {
        die('cant upload');
    }
    $user->setUsername($_POST['username']);
	
    $user->setPhoto(substr($filePath, 1));
	echo $user->getPhoto();
    $user->setEmail($_POST['email']);
    $user->update();
$_SESSION['user']=$user;
    header("Location: account.php");
    exit;
}
?>
<form method="post" enctype="multipart/form-data">
    Username<input name="username" value="<?= $user->getUsername() ?>" />
    <br/>
    Email<input name="email" value="<?= $user->getEmail() ?>" />
    <br/>
    
    Edit Profile Picture:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br/>

    <button type="submit">Update</button>
</form>