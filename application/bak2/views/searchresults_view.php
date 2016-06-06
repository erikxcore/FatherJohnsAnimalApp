    <div class="container theme-showcase" role="main">

      <a href="<?php echo site_url('search') ?>">Go Back to Search</a></br>
      
    <div class="page-header">
        <h1>Search Results</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped table-responsive">
          <thead>
            <tr>
              <th>Name</th>
              <th>Chart Number</th>
              <th>Run</th>
              <th>Species</th>
              <th>Gender</th>
              <th>Status</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php

            $i = 0;
            foreach($allanimals as $animal) { ?>
            <tr>
              <td>
            <?=$animal['name']?>
              </td>
            <td>
            <?=$animal['chart_num']?>
              </td>
              <td style="color:<?php if(isset($animalcolors[$i][0]['color'])){echo $animalcolors[$i][0]['color'];}?>;">
            <?php if(isset($run_names[$i][0]['name'])){echo $run_names[$i][0]['name'];}?>
              </td>
              <td>
            <?=$animal['species']?>
              </td>
              <td>
            <?=$animal['sex']?>
              </td>
              <td>
            <?=$animal['status']?>
              </td>  
              <td>
                <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </td>

            </tr>
          <?php
            $i++;
            } ?>
            </tbody>
        </table>

   </div>