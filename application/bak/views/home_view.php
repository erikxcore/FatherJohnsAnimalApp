    



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
          <?php
            /*
            foreach($emergencyanimals as $animal) {
            */ ?>
            <p>
            <?php /* echo $animal['name']; ?> - <?php echo $animal['chart_num']; */?><br/>
            Medication <?php/* echo $animal['medication_name']; */?> due on <?php /*echo $animal['date_due'] */?></br>
            <a href="<?php/* echo site_url('displayanimal').'/'.$animal['chart_num'] */?>">View Details</a>
            </p>
          <?php
            /*} */?>

-->

          <?php
            foreach($emergencyvaccinationanimals as $animal) { ?>
            <p>
            <?=$animal['name']?> - <?=$animal['chart_num']?><br/>
            Vaccination <?=$animal['vaccination_name']?> completed on <?=$animal['date_completed']?></br>
            <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a>
            </p>
          <?php
            } ?>
          
        <table class="table table-striped table-responsive">
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

        <?php if(isset($custom_homepage_details)) {
        $json = json_decode($custom_homepage_json[0]['sections_json'],true);
        $i = 1;
        $current_section_count = 1;
        while( $i <= $custom_homepage_sections[0]['sections'] ){
        ?>
        <div class="table-wrap" style="width:50%;float:left;">
        <table class="section_<?=$i?>" style="width:200px;margin:0 auto;overflow:auto;padding-bottom:20px;display:block;">
          <?php 
          foreach( $json['sections'] as $section ){
            if( $section['section_id'] == $i ){
              for($z = 1; $z <= $section['section_total_rows'] ; $z++ ){
          ?>
              <tr style="border:1px solid;height:100px;width:200px;">
                  <?php
                  foreach( $runs as $run) {
                    if($run['order_num'] == $current_section_count){
                  ?>
                  <td style="padding:10px;text-align:center;width:200px;<?php foreach($colorandstatus as $color){if($run['id'] == $color['animal_run_num']){ echo 'background-color:'.$color['color']; }}?>">
                  <span>#<?=$z?> </span>
                  <span> <?= $run['name']?></span>
                  
                  <?php
                    foreach($allanimals as $animal){
                      if($animal['run_num'] == $run['id']){
                  ?>
                      <br/>
                      <span><?=$animal['name']?> - <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a></span>
                      <br/>
                      <span>Status : <?=$animal['status']?></span>
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
      </div>
   </div>