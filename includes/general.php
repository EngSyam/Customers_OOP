<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 20/07/2018
 * Time: 04:20 م
 */
function uniqueName()
{
    $newName= uniqid('SYam_').time().rand(10000,100000);
    return $newName;
}
function getExt($name)
{
    $Ext=end(explode('.',"$name"));
    return $Ext;
}
function CheckLength($string,$num,$spaces=false)
{
    if($spaces==true)
        $string=time($string);
    return(strlen($string)<$num)?false : true;
}
function CheckEmail($email)
{
    return filter_var($email,FILTER_VALIDATE_EMAIL);
}