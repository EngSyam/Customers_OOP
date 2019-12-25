<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 16/07/2018
 * Time: 02:57 م
 */
session_start();
require('includes/config.php');
require('includes/usersClass.php');
require('includes/general.php');
$add= new users();
if(!$add->CheckLogin())
    header("LOCATION:login.php");
if(count($_POST)>0)
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    //images jpg
    $errors=[];
    //check
    if($_FILES['image']['type']!=='image/png')
        $errors[]='only png images are allowed';
    if($_FILES['image']['size'] > 4*1024*1024)
        $errors[]='max file size exceeded';
    if($_FILES['image']['error'] > 0)
        $errors[]='error no. '.$_FILES['image']['error'].'occurred';
    if(CheckLength($username,5,true))
        $errors[]='username mustbe > 5 Chars';
    $newName='no-image.jpg';
    if(count($errors)==0)
    {
        $image=uniqueName().'.'.getExt($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],'upload/'.$image);
    }
    if($add->add_user($username,$password,$image))
        echo'user added successfully';
    else
        echo'user not added';
}
else{
?>
<html>
<form action="Add_User.php"method="post" enctype="multipart/form-data">
    username <input type="text" name="username"><br>
    password <input type="text" name="password"><br>
    image    <input type="file" name="image">
    <button type="submit">add user</button>
</form>
</html>
<?php } ?>