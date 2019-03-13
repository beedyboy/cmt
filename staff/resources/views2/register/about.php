<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	 <style>
  	
body{
	 box-sizing: border-box;
	background-color: skyblue;
}
div.form-div{
	display: flex;
	flex-flow: column wrap;
	justify-content: space-around;
	align-items: center;
	background:  rgba(125,256,255, 0.5);
	box-shadow: white;
}
form{
	display: flex;
	flex-flow: column wrap; 
	justify-content: center;
	flex-basis: 100%;
	background: #FFF;
	box-shadow: white;
	border-radius: 10px;
	margin: 0.6rem;
}
input, button{
	margin: 0.2rem;
	padding: 0.2rem;
	border: none;
	border-bottom: 2px solid blue;
	box-sizing: border-box;
}

 input:hover{
	margin: 0.2rem;
	padding: 0.2rem;
	color: red;
	border: none;
	box-sizing: border-box;
}

.btn-success{
	background: green;
	color: white;
	border-radius: 5px;
	padding: 5px;
}
.alert-danger{
	background: #C82333;
 

}
.text-warning
{

	color: #FFF;
}

  </style>
</head>
<body>
	 
<div class="form-div">
	<h3>Log In </h3>

<form action="<?=base_url ?>register/login" method="post">

	<?php 
// echo    password_hash('beedy', 1);
 
?>

<div class="alert ">
	 	<?=$this->displayErrors ?>
	 </div>


<label>Username</label>
<br />
<input type="text" name="username" id="username">

<br />
<br />

<label>Password</label>
<br />
<input type="password" name="password" id="password">

<br />

<br />
<label>Remember Me <input type="checkbox" name="remember_me" id="remember_me" value="on"></label>

<br />
<br />

<button class="btn-success"> Login </button>  
</form>
	
<a href="<?=base_url ?>register/create">Register</a>
</div>
 
</body>
</html>