    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Vaccinations</h1>
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
              <th>Brand Name</th>
              <th>Expiration Date</th>
              <th>Serial Number</th>
              <th>Type</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($allvaccinations as $vaccination) { ?>
            <tr>
              <td>
            <?=$vaccination['id']?>
              </td>
             <td>
            <?=$vaccination['name']?>
              </td>
            <td>
            <?=$vaccination['brand_name']?>
              </td>
            <td>
            <?=$vaccination['expiration_date']?>
              </td>
            <td>
            <?=$vaccination['serial_number']?>
              </td>
            <td>
            <?=$vaccination['type']?>
              </td>
              <td>
                <a href="<?php echo site_url('editvaccinationname').'/'.$vaccination['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displayvaccinations/removevaccinationname/<?=$vaccination['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addvaccinationname') ?>">Add a Vaccination</a>

      </div>



   </div>