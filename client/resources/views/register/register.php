  
<div style="display: block; position: absolute; left:30%; width: 40%;">


<form action="<?=base_url ?>register/create" method="post">
	<h3>Register</h3>
	<?php 
// echo    password_hash('beedy', 1);
 
?>

<div class="alert alert-danger">
	 	<?=$this->displayErrors ?>
	 </div>


<label>FistName</label>
<br />
<input type="text" name="firstname" id="firstname" value="<?=$this->post['firstname']?>">

<br />
<br />

<label>LastName</label>
<br />
<input type="text" name="lastname" id="lastname" value="<?=$this->post['lastname']?>">

<br />
<br />

<label>Email</label>
<br />
<input type="email" name="email" id="email" value="<?=$this->post['email']?>">

<br />
<br />

<label>Choose a Username</label>
<br />
<input type="text" name="username" id="username" value="<?=$this->post['username']?>">

<br />
<br />

<label>Choose a Password</label>
<br />
<input type="password" name="password" id="password" value="<?=$this->post['password']?>">

<br />
 
<br />
<label>Confirm Password</label>
<br />
<input type="password" name="confirm" id="confirm" value="<?=$this->post['confirm']?>">

<br />
 
<br />

<input type="submit" value="Register">
</form>
	
<a href="<?=base_url ?>register/login">Already Registered? Login</a>
</div>
 