<?php include "include/db.php";?>
<?php include "include/header.php";?>
<?php session_start();?>
<?php
echo LoggedInUserId();

if(userLikedthisPost(15)){
  echo "user liked it";
}else{
  echo "user did not liked it";
}