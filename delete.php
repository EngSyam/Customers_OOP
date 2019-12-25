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
$user= new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");
$id = isset($_GET['id'])?(int)$_GET['id'] : 0 ;
$delete=new clients();
if($delete->deleteClient($id))
    echo'deleted';
else
    echo'not deleted';
