 <?php $this->setSiteTitle(APP_NAME.' | Login'); ?>

 <?php $this->start('body') ?>
 
      <?php 
      // <?=base_url    <form method="post" 
// echo    password_hash('beedyboy', 1);
?>
 
 <div class="alert hide" id='message'>
	 	 
	 </div>
  
 <form class="login-form" id="login-form" action="<?=base_url ?>login/authenticate" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="email" class="form-control"  name="email" placeholder="email" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <label class="checkbox">
                <input type="checkbox" name="remember_me" value="on"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
        <!-- <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button> -->
      </div>
    </form> 
<?php $this->end() ?>

<?= $this->start('scripts'); ?> 


<?php $this->end() ?>
