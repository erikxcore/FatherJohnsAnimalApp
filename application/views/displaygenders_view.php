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
              <th>ID</th>
              <th>Name</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($allgenders as $gender) { ?>
            <tr>
              <td>
            <?=$gender['id']?>
              </td>
            <td>
            <?=$gender['name']?>
              </td>
              <td>
                <a href="<?php echo site_url('editgendername').'/'.$gender['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displaygenders/removegendername/<?=$gender['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addgendername') ?>">Add a Gender</a>

      </div>



   </div>