<?php
session_start();
if(!isset($_SESSION['userid'])){
header('location:../index.php');
}
$session_Id = $_SESSION['userid'];
?>