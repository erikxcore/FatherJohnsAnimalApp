    <div class="container theme-showcase" role="main">


    <div class="page-header">
        <h1>Change Your Password</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('changeuserpassword'); ?>

    <div class="form-group">
     <label for="username">Username:</label>
     <input class="form-control" readonly type="text" size="20" id="username" name="username" value="<?php echo $username; ?>"/>
    </div>

    <div class="form-group">
     <label for="username">Password:</label>
     <input type="password" size="20" id="password" name="password" class="form-control"/>
    </div> 


     <input class="btn btn-success" type="submit" value="Change Password"/>
   </form>
 </div>