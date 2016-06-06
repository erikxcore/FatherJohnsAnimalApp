
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
         <h1>Home</h1>
         <h2>Welcome <?php echo $username; ?>!</h2>
    </div>

    <div class="page-header">
        <h1>Display Users</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

      <div class="form-group">
          <ul>
          <?php
            foreach($usernames as $username) { ?>
             <li><?= $username['username'] ?></li>
          <?php
            } ?>
          </ul>
      </div>

   </form>

 </div>