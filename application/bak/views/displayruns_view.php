    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Content</h1>
    </div>
      <div class="well">

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Order Number</th>
              <th>Name</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($allruns as $run) { ?>
            <tr>
              <td>
            <?=$run['order_num']?>
              </td>
            <td>
            <?=$run['name']?>
              </td>
              <td>
                <a href="<?php echo site_url('editrun').'/'.$run['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displayruns/removerun/<?=$run['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addrun') ?>">Add a Run</a>

      </div>



   </div>