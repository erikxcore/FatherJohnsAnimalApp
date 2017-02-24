    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Medications due on <?php echo $date ?></h1>
    </div>
      <div class="well">
      <a href="javascript:history.back();">Go Back</a></br>
      <a style="float:right;" href="#" onclick="window.print();">Print</a></br>

        <div class="full_width" style="width:100%;float:left;clear:both;">
              <div class="overdue_vac" style="width:50%;float:left;">
              <?php if( !empty($overduemedications) ){ ?>
              <p style="font-weight:bold;color:red;font-size: 18px;">Overdue Medications Due</p> 
              <?php 
              foreach($overduemedications as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Medication <?=$animal['medication_name']?> due on <?=$animal['date_due']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>
              <?php } ?>
              </div>

              <div class="all_vac" style="width:50%;float:left;">
              <?php if( !empty($allmedications) ){ ?>
              <p style="font-weight:bold;font-size: 18px;">Medications Due</p> 
              <?php }
              foreach($allmedications as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Medication <?=$animal['medication_name']?> due on <?=$animal['date_due']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>
              </div>
        </div> 

    </div>



   </div>