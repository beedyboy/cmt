 <?php $this->setSiteTitle('Logins Page'); ?>

 <?php $this->start('body') ?>
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
   <?php $this->end() ?>