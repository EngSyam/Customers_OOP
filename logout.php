<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 08/07/2018
 * Time: 01:04 م
 */
session_start();
require('includes/usersClass.php');
$user= new users();
$user->logout();
    header("LOCATION:login.php");