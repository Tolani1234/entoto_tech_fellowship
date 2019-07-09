<?php

/* 
 * To change this license header, choose License Headers in Proje
 * 
 */
include_once 'dblogin.php';
if(isset($_POST['Full_name']) and isset($_POST['age']) and isset($_POST['phone']) and isset($_POST['email'])){
 $full_name=$_POST['Full_name'];
 $age=$_POST['age'];
 $phone=$_POST['phone'];
 $email=$_POST['email'];
$db=new dblogin();
$result=$db->signup($full_name,$age,$phone,$email);
if($result=='1'){
    echo'succefuly inserted';
}else{
    echo'error';
}
}
