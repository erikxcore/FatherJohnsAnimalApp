    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Statuses</h1>
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
              <th>Color</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($allstatuses as $status) { ?>
            <tr>
              <td>
            <?=$status['id']?>
              </td>
            <td>
            <?=$status['name']?>
              </td>
            <td style="background-color:<?=$status['color']?>">
            <?=$status['color']?>
              </td>
              <td>
                <a href="<?php echo site_url('editstatusname').'/'.$status['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displaystatuses/removestatusname/<?=$status['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addstatusname') ?>">Add a Status</a>

      </div>



   </div>