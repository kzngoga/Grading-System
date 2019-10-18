<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form validation with JavaScript</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="wrapper">
   <form method="POST" action="action.php" onsubmit="return Validate()" name="vform" >
   	<div id="username_div">
   	  <label>Username</label> <br>
   	  <input type="text" name="username" class="textInput">
   	  <div id="name_error"></div>
   	</div>
   	<div id="email_div">
   	  <label>Email</label> <br>
   	  <input type="email" name="email" class="textInput">
   	  <div id="email_error"></div>
   	</div>
   	<div id="password_div">
   	  <label>Password</label> <br>
   	  <input type="password" name="password" class="textInput">
   	</div>
   	<div id="pass_confirm_div">
   	   <label>Password confirm</label> <br>
   	   <input type="password" name="password_confirm" class="textInput">
   	   <div id="password_error"></div>
   	</div>
   	<div>
   	<input type="submit" name="register" value="Register" class="btn">
   	</div>
   </form>
  </div>
</body>
</html>
<script type="..js/main2.js"></script>