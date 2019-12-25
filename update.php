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
$user = new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");
$update=new clients();
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
    $newName='no-image.jpg';
    if(count($errors)==0)
    {
        $newName=uniqueName().'.'.getExt($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],'upload/'.$newName);
    }

    $id    = $_POST['client_id'];
    if($update->updateClient($id,$name,$email,$city,$phone,$newName))
        echo'user updated successfully';
    else
        echo 'user not updated';
}
else{
$id=isset($_GET['id'])?(int)$_GET['id'] : 0;
$client = $update->getClient($id);
if(count($client) == 0 )
exit('Invalid client selected');
?>
<html>
<form action="update.php" method="post" enctype="multipart/form-data">
    name  <input type="text" name="name" value="<?php echo $client['name']; ?>"><br>
    email <input type="text" name="email"value="<?php echo $client['email']; ?>"><br>
    city  <input type="text" name="city" value="<?php echo $client['city']; ?>"><br>
    phone <input type="text" name="phone"value="<?php echo $client['phone']; ?>"><br>
    image <input type="file" name="image"value="<?php echo $client['image']; ?>"><br>
    id    <input type="hidden" name="client_id" value="<?php echo $client['id'];?>">
    <button type="submit">Add Client</button>
</form>
</html>
<?php }?>