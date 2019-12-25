<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 16/07/2018
 * Time: 02:57 م
 */
session_start();
require 'includes/config.php';
require 'includes/usersClass.php';
$user = new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if(count($_POST) > 0)
{
    $password = $_POST['password'];
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

    if($user->updateUser($id,$password,$newName))
        echo 'user updated successfully';
    else
        echo 'user not updated';
}
else
{
    $user =$user->getUser($id);
    if(count($user) == 0)
        exit('invalid user selected');
    ?>
    <form action="Update_User.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        password <input type="text" name="password" value="<?php echo $user['password']; ?>" /><br />
        Image <input type="file" name="image" /><br />
        <button type="submit">update user</button>
    </form>
<?php } ?>