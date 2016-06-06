    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
         <h1>Home</h1>
         <h2>Welcome <?php echo $username; ?>!</h2>
    </div>

    <div class="page-header">
        <h1>Change A User's Password</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('changeallpassword'); ?>

      <div class="form-group">
        <select name="username" id="username">
          <option clas="form-control" selected="selected" value="">Choose a user</option>
          <?php
            foreach($usernames as $username) { ?>
              <option value="<?= $username['username'] ?>"><?= $username['username'] ?></option>
          <?php
            } ?>
        </select> 
      </div>
      
    <div class="form-group">
     <label for="username">Password:</label>
     <input type="password" size="20" id="password" name="password" class="form-control"/>
    </div> 


     <input class="btn btn-success" type="submit" value="Change Password"/>

   </form>

 </div>