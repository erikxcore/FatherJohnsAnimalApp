
    <div class="container theme-showcase" role="main">


    <div class="page-header">
        <h1>Promote User</h1>
    </div>
    
    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('promoteuser'); ?>

      <div class="form-group">
        <select name="username" id="username" style="color:black;">
          <option class="form-control" selected="selected" value="">Choose a user</option>
          <?php
            foreach($usernames as $username) { ?>
              <option value="<?= $username['username'] ?>"><?= $username['username'] ?></option>
          <?php
            } ?>
        </select> 
      </div> 

     <input class="btn btn-success" type="submit" value="Promote User"/>
   </form>

   </div>