    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Vaccinations due on <?php echo $date ?></h1>
    </div>
      <div class="well">
      <a href="<?=site_url();?>">Go Back</a></br>

        <div class="full_width" style="width:100%;float:left;clear:both;">
              <div class="dog_vac" style="width:50%;float:left;">
              <?php if( !empty($allvaccinations) ){ ?>
              <p style="font-style:bold;">Vaccinations Due</p> 
              <?php }
              foreach($allvaccinations as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Vaccination <?=$animal['vaccination_name']?> due on <?=$animal['date_completed']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>
              </div>
        </div> 

    </div>



   </div>