<?php
 $con=mysqli_connect('127.0.0.1','root','');
 if($con){
     echo'not connected to Server';
 }
 if(!mysqli_selact_db($con,'tutorial'));
 {
   echo 'data base not selected' ;
 }
 $Name=$-POST['UserName'];
     $Email=$-POST['Email'];
     $sqli 
?>
