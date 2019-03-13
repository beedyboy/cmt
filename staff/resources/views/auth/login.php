 <?php $this->setSiteTitle('Login Page'); ?>

 <?php $this->start('body') ?>
 
	<?php 
echo     password_hash('Salvation91#', 1);
 
?>

<div class="alert ">
	 	<?=$this->displayErrors ?>
	 </div>

 <form class="login-form" action="<?=base_url ?>auth/login" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" placeholder="Username" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" placeholder="Password">
        </div>
        <label class="checkbox">
                <input type="checkbox" name="remember_me" value="on"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>
      </div>
    </form> 
  
</div>
   <?php $this->end() ?>