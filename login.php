<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 08/07/2018
 * Time: 12:07 م
 */
session_start();
require('includes/config.php');
require('includes/usersClass.php');
$user= new users();
if($user->CheckLogin())
    header("LOCATION:index.php");
if(count($_POST)>0)
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    if($user->login($username,$password))
        header('LOCATION:index.php');
    else
        echo'invalid login';
}
?>
<html>
<form action="login.php" method="post">
    username <input type="text"name="username"><br>
    password <input type="password"name="password"><br>
    <button type="submit">Login</button>
</form>
</html>