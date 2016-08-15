<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Father John's Adoption Private Manager">
    <meta name="author" content="Eric Barber">
    <link rel="icon" href="<?php echo base_url("assets/favicon.ico");?>">
   <title>Login</title>
   <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" />
   <link rel="stylesheet" href="<?php echo base_url("assets/css/theme.css"); ?>" />

   <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>"></script>
   <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>

 </head>
 <body role="document">
  <div class="container">
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifylogin', array(
    'class' => 'form-signin'
));?>
     <h2 class="form-signin-heading">Please sign in</h2>
     <label for="username">Username:</label>
     <input type="text" size="20" id="username" name="username" class="form-control" value="<?=set_value('username')?>"/>
     <br/>
     <label for="password">Password:</label>
     <input type="password" size="20" id="passowrd" name="password" class="form-control" value="<?=set_value('password')?>"/>
     <br/>
     <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
   </div>
   </form>
 </div>
 </body>
</html>