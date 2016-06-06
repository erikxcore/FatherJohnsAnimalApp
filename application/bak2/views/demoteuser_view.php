    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
         <h1>Home</h1>
         <h2>Welcome <?php echo $username; ?>!</h2>
    </div>

    <div class="page-header">
        <h1>Demote User</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('demoteuser'); ?>

      <div class="form-group">
        <select name="username" id="username">
          <option class="form-control" selected="selected" value="">Choose a user</option>
          <?php
            foreach($usernames as $username) { ?>
              <option value="<?= $username['username'] ?>"><?= $username['username'] ?></option>
          <?php
            } ?>
        </select> 
      </div>

    <input class="btn btn-success" type="submit" value="Demote User"/>

   </form>

 </div>