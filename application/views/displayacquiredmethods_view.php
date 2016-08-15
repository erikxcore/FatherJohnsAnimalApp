    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Acquired By Methods</h1>
    </div>
      <div class="well">

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($allmethods as $method) { ?>
            <tr>
              <td>
            <?=$method['id']?>
              </td>
            <td>
            <?=$method['name']?>
              </td>
              <td>
                <a href="<?php echo site_url('editacquiredname').'/'.$method['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displayacquiredmethods/removeacquiredname/<?=$method['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addacquiredname') ?>">Add a method</a>

      </div>



   </div>