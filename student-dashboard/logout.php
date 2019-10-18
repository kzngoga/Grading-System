<?php
session_start();
if(session_destroy()){
echo "<script>window.open('../student-login.php','_self')</script>";
}
?>