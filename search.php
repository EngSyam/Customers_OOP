<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 06/07/2018
 * Time: 10:29 ص
 */
session_start();
require('includes/config.php');
require('includes/ClientsClass.php');
require('includes/usersClass.php');
$user= new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");
$keyword = isset($_GET['keyword'])?$_GET['keyword'] : '';
$search  =new clients();
$clients = $search->searchClients($keyword);
?>
<html>
<h1>Search Results</h1>
<form action="search.php"method="get">
    Search <input type="text" name="keyword"value="<?php echo $keyword; ?>">
    <button type="submit">Search</button>
</form>
<table border="1">
    <th>id</th>
    <th>name</th>
    <th>email</th>
    <th>city</th>
    <th>phone</th>
    <th>Image</th>
    <th>controller</th>
    <?php
    foreach($clients as $client)
    {
        $id    = $client['id'];
        $name  = $client['name'];
        $email = $client['email'];
        $city  = $client['city'];
        $phone = $client['phone'];
        $Image = $client['image'];
        echo
        "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$email</td>
                <td>$city</td>
                <td>$phone</td>
                <td><img width='100' height='100' src='upload/$Image'></td>
                <td>
                <a href='update.php?id=$id'>UPDATE</a>
                <a href='delete.php?id=$id'>DELETE</a>
                </td>
            </tr>
            ";
    }
    ?>
</table>
</html>
