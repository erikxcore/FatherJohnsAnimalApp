<script type="text/javascript">
$( document ).ready(function() {

$(".date_search").click(function(event) {
  event.preventDefault();
$('#search_date').datepicker().focus();
}); 

$("#search_date").datepicker('destroy');

$("#search_date").datepicker().attr("readonly", "readonly");

$("#search_date").on('changeDate', function (ev) { 
        var date = $(this).val();
        window.location.href = "<?php echo site_url() ?>dailyvaccination?date="+date;
});

});

</script>
 
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
         <h1>Home</h1>
         <h2>Welcome <?php echo $username; ?>!</h2>
    </div>


      <div class="well" style="overflow:auto;">

        <?php if(!empty($this->session->flashdata('results'))){ ?>
            <?php echo $this->session->flashdata('results') . '</br>';?>
        <?php } ?>
<!--
          <?php /*
            foreach($emergencyanimals as $animal) {?>
            <p style="width:100%;display:none;">
            <?php echo $animal['name']; ?> - <?php echo $animal['chart_num']; ?><br/>
            Medication <?php echo $animal['medication_name']; ?> due on <?php echo $animal['date_due'] ?></br>
            <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
            </p>
          <?php
            } */?>

          <?php /*
            foreach($emergencyvaccinationanimals as $animal) { ?>
            <p style="width:100%;display:none;">
            <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
            Vaccination <?=$animal['vaccination_name']?> due on <?=$animal['date_completed']?></br>
            <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
            </p>
          <?php
            } */?>
-->
          <div style="width:100%;float:left;clear:both;">
            <div class="form-group">
                 <a href="#" class="date_search">Search for vaccination on a specific date</a>
                 <input style="height:0px;width:0px;float:left;display:inline;background:transparent;"value="" type="text" size="20" id="search_date" name="search_date" class="datepicker form-control" data-date-format="yyyy-mm-dd"/>
            </div>
          </div> 

        <div class="full_width" style="width:100%;float:left;clear:both;">
              <div class="dog_vac" style="width:50%;float:left;">
              <?php if( !empty($overduevaccinationsDogs) ){ ?>
              <p style="font-weight:bold;color:red;font-size: 18px;">Overdue Dog Vaccinations Due</p> 
              <?php }
              foreach($overduevaccinationsDogs as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Vaccination <?=$animal['vaccination_name']?> due on <?=$animal['date_given']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>


              <?php if( !empty($emergencyvaccinationdogs) ){ ?>
              <p style="font-weight:bold;font-size: 18px;">Dog Vaccinations Due</p> 
              <?php }
              foreach($emergencyvaccinationdogs as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Vaccination <?=$animal['vaccination_name']?> due on <?=$animal['date_given']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>
              </div>

              <div class="cat_vac" style="width:50%;float:right;">
              <?php if( !empty($overduevaccinationsDogs) ){ ?>
              <p style="font-weight:bold;color:red;font-size: 18px;">Overdue Cat Vaccinations Due</p>
              <?php }
              foreach($overduevaccinationsDogs as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Vaccination <?=$animal['vaccination_name']?> due on <?=$animal['date_given']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>


              <?php if( !empty($emergencyvaccinationcats) ){ ?>
              <p style="font-weight:bold;font-size: 18px;">Cat Vaccinations Due</p>
              <?php }
              foreach($emergencyvaccinationcats as $animal) { ?>
              <p style="width:100%;">
              <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
              Vaccination <?=$animal['vaccination_name']?> due on <?=$animal['date_given']?></br>
              <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
              </p>
            <?php
              } ?>
            </div>
        </div>

        <div class="table-responsive" style="clear:both;">  
        <table class="table table-striped">
          <caption>Latest Additions</caption>
          <thead>
            <tr>
              <th>Name</th>
              <th>Chart Number</th>
              <th>Run Number</th>
              <th>Species</th>
              <th>Gender</th>
              <th>Status</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>

          <?php
          $i = 0;
            foreach($recentanimals as $animal) { ?>
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

        <?php if(isset($custom_homepage_details)) {
        $json = json_decode($custom_homepage_json[0]['sections_json'],true);
        $i = 1;
        $current_section_count = 1;
        while( $i <= $custom_homepage_sections[0]['sections'] ){
        ?>
        <div class="custom_homepage_table_wrap">
        <table class="custom_homepage_table section_<?=$i?>">
          <?php   
          foreach( $json['sections'] as $section ){
            if( $section['section_id'] == $i ){
              for($z = 1; $z <= $section['section_total_rows'] ; $z++ ){
          ?>
              <tr class="custom_homepage_row">
                  <?php
                  foreach( $runs as $run) {
                    if($run['order_num'] == $current_section_count){
                  ?>
                  <td class="custom_homepage_cell">
                  <span style="width:100%;display:block;background-color: #d2d2d2;color: black;font-weight: bold;text-transform: uppercase;padding: 5px;"> <?= $run['name']?></span>
                  <?php
                    foreach($allanimals as $animal){
                      if($animal['run_num'] == $run['id']){
                  ?>   
                      <div style="<?php foreach($colorandstatus as $color){if($run['id'] == $color['animal_run_num'] && $animal['chart_num'] == $color['animal_chart_num']){ echo 'background-color:'.$color['color'].';color:white;'; }}?>">
                        <span><?=$animal['name']?> - <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a></span>
                        <br/>
                        <span>Status : <?=$animal['status']?></span>
                        <br/>
                        <span>Chart Number : <?=$animal['chart_num']?></span>
                      </div>
                  <?php
                      }
                    }

                  ?>
                  </td>
                  <?php
                      }
                    }
                  ?>
              </tr>
          <?php
          $current_section_count++;
                }
              }
            }
          ?>
        </table>
      </div>
        <?php
        $i++;
        }
      }
        ?>
       
        <!-- Cat/Other Run Addition -->
        <?php if(isset($custom_homepage_details)) { ?>
        <div class="other_runs">
          <?php
            foreach( $other_runs as $run){
          ?>
          <h4><?=$run['name']?></h4>
          <div class="table-responsive">
            <table class="table">
          <?php
                foreach($allanimals as $animal){
                  if($animal['run_num'] == $run['id']){
          ?>
                      <tr colspan="5" style="text-align:center;">
                        <td colspan="2" ><?=$animal['name']?></td>
                        <td colspan="1" style="<?php foreach($colorandstatus as $color){if($run['id'] == $color['animal_run_num'] && $animal['chart_num'] == $color['animal_chart_num']){ echo 'background-color:'.$color['color'].';color:white;'; }}?>">Status : <?=$animal['status']?></td>
                        <td colspan="1" >Chart Number : <?=$animal['chart_num']?></td>
                        <td colspan="1" ><a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a></td>
                      </tr>
          <?php 
                  }
                }
           ?> </table> </div>
           <?php } ?>
        </div>
        <?php } ?>

      </div>
   </div>