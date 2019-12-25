<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 06/07/2018
 * Time: 10:28 ص
 */
session_start();
require('includes/config.php');
require('includes/ClientsClass.php');
require('includes/usersClass.php');
require('includes/general.php');
$user= new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");

if(count($_POST)>0)
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $city  = $_POST['city'];
    $phone = $_POST['phone'];
    //images jpg
    $errors=[];
    //check
    if($_FILES['image']['type']!=='image/png')
        $errors[]='only png images are allowed';
    if($_FILES['image']['size'] > 4*1024*1024)
        $errors[]='max file size exceeded';
    if($_FILES['image']['error'] > 0)
        $errors[]='error no. '.$_FILES['image']['error'].'occurred';
    if(CheckLength($name,5,true))
        $errors[]='username mustbe > 5 Chars';
    if(CheckEmail($email))
        $errors[]='please write Invalid Email';
    $newName='no-image.jpg';
    if(count($errors)==0)
    {
        $newName=uniqueName().'.'.getExt($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],'upload/'.$newName);
    }
    $add=new clients();
    if($add->addClient($name,$email,$city,$phone,$newName))
        echo'user added successfully';
    else
        echo'error adding user';
}
else{
?>
<html>
<form action="add.php"method="post" enctype="multipart/form-data">
    name  <input type="text" name="name"><br>
    email <input type="text" name="email"><br>
    city  <input type="text" name="city"><br>
    phone <input type="text" name="phone"><br>
    image <input type="file" name="image"><br>
    <button type="submit">Add Client</button>
</form>
</html>
<?php }?>