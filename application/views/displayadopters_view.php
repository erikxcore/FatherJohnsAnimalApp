    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Adopters</h1>
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
              <th style="display:none;">Assigned Chart Number</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($alladopters as $adopter) { ?>
            <tr>
              <td>
            <?=$adopter['id']?>
              </td>
            <td>
            <?=$adopter['name']?>
              </td>
            <td style="display:none;">
            <?=$adopter['chart_num']?>
              </td>
              <td>
                <a href="<?php echo site_url('displayadopter').'/'.$adopter['id'] ?>">View Details</a>
              </td>
              <td>
                <a href="displayadopters/removeadopter/<?=$adopter['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>
   <div class="paged_links"><?php echo $links; ?></div>

                <a href="<?php echo site_url('addadopter') ?>">Add an Adopter</a>

      </div>



   </div>