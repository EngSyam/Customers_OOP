<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 16/07/2018
 * Time: 02:58 م
 */
session_start();
require('includes/config.php');
require('includes/usersClass.php');
$get = new users();
if(!$get->CheckLogin())
    header("LOCATION:login.php");
$Users=$get->getUsers();
?>
<html>
welcome <?php echo $_SESSION['username']?> || <a href="logout.php">logout</a><hr>
<form action="Search_User.php"method="get">
    Search <input type="text" name="keyword">
    <button type="submit">Search</button>
</form>
<table border="1">
    <tr>
        <td>id</td>
        <td>username</td>
        <td>password</td>
        <td>image</td>
        <td>control</td>
    </tr>
    <?php
    foreach ($Users as $User)
    {
        $id         = $User['id'];
        $username   = $User['username'];
        $password   = $User['password'];
        $image      =  $User['image'];

        echo "
                <tr>
                    <td>$id</td>
                    <td>$username</td>
                    <td>$password</td>
                    <td><img width='100' height='100' src='upload/$image'></td>
                    <td>
                        <a href='Delete_User.php?id=$id'>delete</a>
                        <a href='Update_User.php?id=$id'>update</a>
                    </td>
                </tr>
            ";
    }

    ?>

</table>
<a href="index.php">All clients</a><br />
<a href="Add_User.php">add new User</a>

</html>