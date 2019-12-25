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
$delete=new users();
if(!$delete->CheckLogin())
    header("LOCATION:login.php");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($delete->delete_user($id))
    echo'deleted';
else
    echo'not deleted';