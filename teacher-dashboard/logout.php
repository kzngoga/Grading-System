<?php
session_start();
if(session_destroy()){
echo "<script>window.open('../teacher-login.php','_self')</script>";
}
?>