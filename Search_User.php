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
$user= new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");
$keyword=isset($_GET['keyword'])?$_GET['keyword']:'';
$users=$user->search_user($keyword);
?>
<html>
<form action="Search_User.php" method="get">
    Search<input type="text" name="keyword" value="<?php echo $keyword ?>">
    <button type="submit">Search</button>
</form>
<table border="1">
    <th>id</th>
    <th>username</th>
    <th>password</th>
    <th>Image</th>
    <th>controller</th>
    <?php
    foreach($users as $user)
    {
        $id       = $user['id'];
        $username = $user['username'];
        $password = $user['password'];
        $Image    = $user['image'];
        echo
        "
        <tr>
            <td>$id</td>
            <td>$username</td>
            <td>$password</td>
            <td><img width='100' height='100' src='upload/$Image'></td>
            <td>
                <a href='Update_User.php?id=$id'>UPDATE</a>
                <a href='Delete_User.php?id=$id'>DELETE</a>
            </td>
        </tr>
        ";
    }
    ?>
</table>
</html>