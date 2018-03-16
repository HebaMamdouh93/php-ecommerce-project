<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//TODO
// if sumbit
// check username and password
// incase of true ==> redirect to account.php
// incase of false ==> show error username and password

include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/User.php';
include '../model/Users.php';
$error = "";
if(!empty($_POST))
{
	

    if(!isset($_POST['username']) || !$_POST['username'])
    {
		//error

        $error .= "No Username given<br>";
    }

    if(!isset($_POST['password']) || !$_POST['password'])
    {
		//error

        $error .= "No Password given<br>";
    }

    //Success $_POST['username'] $_POST['password']
    if($error == "")
    {
		
        $loggedIn = false;
		$users = new Users($conn);
		$usersObjs=$users -> getUsers();
		      // echo "<pre>";
               //print_r($usersObjs);
               //echo "</pre>";
		
        foreach($usersObjs as $user)
        {
			//print_r($user);
            if($user ->getUsername() == $_POST['username'] && $user ->getPassword() == $_POST['password'])
            {
                //true login
			
                session_start();
                $_SESSION['user'] = $user;
				$_SESSION['userId']=$user->getId();
				$_SESSION['products']=array();
                $loggedIn = true;
				
                break;
				
            }
        }
        if($loggedIn)
        {
            //acount.php
			
            header('Location: account.php');
            exit;
        }
        else
        {
            //error
            $error .= "Erorr username and password";
        }
		
    }
}
?>
<style>
    .error{
        color: red;
    }
</style>
<h1>Please Login to your account</h1>
<div class="error">
    <?php echo $error ?>
</div>
<form method="post">
    <input name="username" type="text" />
    <br/>
    <br/>
    <input name="password" type="password" />
    <br/>
    <br/>
    <button type="submit">Login</button>
</form>