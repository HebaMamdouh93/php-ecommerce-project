<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/User.php';

$errorUsername = $errorPassword = "";
if(!empty($_POST))
{
    if(!isset($_POST['username']) || !$_POST['username'])
    {
        $errorUsername .= "This Field required.";
    }
    else
    {
        if(strlen($_POST['username']) > 20 || strlen($_POST['username']) < 5)
        {
            $errorUsername .= "Max Length is 20Char AND Min Length 6";
        }
        
    }

    if(!isset($_POST['password']) || !$_POST['password'] || !isset($_POST['confirm_password']) || !$_POST['confirm_password'])
    {
        $errorPassword = "Password ANd confirm paswword is required";
    }
    else
    {
        if($_POST['password'] != $_POST['confirm_password'])
        {
            $errorPassword = "Password Not Match";
        }
    }
    if($errorPassword == "" && $errorUsername == "")
    {
        //mysqli_query($conn, $sql)
        session_start();
        $filename = $_FILES['fileToUpload']['tmp_name'];
        $filePath = '/uploads/usersImages/' . time() . '.png';
        $destination = __DIR__ . $filePath;
        if(!move_uploaded_file($filename, $destination))
        {
            die('cant upload');
        }
        $user = new User($conn);
        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setPhoto(substr($filePath, 1));
        $_SESSION['userId'] = $user->save();
        $_SESSION['user']=$user;
        $_SESSION['products']=array();
        
        header('Location: account.php');
        exit;
    }
}
?>
<html>
    <head>

    </head>
    <body>
        <h1>Register Now!!!</h1>
        <form method="post" enctype="multipart/form-data">
            Username:<input name="username" type="text"  value="<?php echo isset($_POST['username']) ? $_POST['username'] : "" ?>"/>
            <br/>
            <?php echo $errorUsername ?>
            <br/>
            Email:<input name="email" type="email" />
            <br/>
            <br/>
            Password<input name="password" type="password" />
            <br/>
            <br/>
            Confirm Password:<input name="confirm_password" type="password" />
            <br/>
            <?php echo $errorPassword ?>
            <br/>
            Choose The Profile picture :
            <br/>
            <input type="file" name="fileToUpload" id="fileToUpload"/> 
            <br/>
            <br/>            
            <br/>

            <button type="submit">Register</button>
        </form>
    </body>
</html>
