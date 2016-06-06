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
            foreach($allspecies as $species) { ?>
            <tr>
              <td>
            <?=$species['id']?>
              </td>
            <td>
            <?=$species['name']?>
              </td>
              <td>
                <a href="<?php echo site_url('editspeciesname').'/'.$species['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displayspecies/removespeciesname/<?=$species['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addspeciesname') ?>">Add a Species</a>

      </div>



   </div>