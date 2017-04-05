<script type="text/javascript">
$( document ).ready(function() {

$(".date_search").click(function(event) {
  event.preventDefault();
$('#search_date').datepicker().focus();
}); 

$(".date_search_2").click(function(event) {
  event.preventDefault();
$('#search_date_2').datepicker().focus();
}); 

$("#search_date").datepicker('destroy');
$("#search_date_2").datepicker('destroy');

$("#search_date").datepicker().attr("readonly", "readonly");
$("#search_date_2").datepicker().attr("readonly", "readonly");

$("#search_date").on('changeDate', function (ev) { 
        var date = $(this).val();
        window.location.href = "<?php echo site_url() ?>dailydogvaccination?date="+date;
});

$("#search_date_2").on('changeDate', function (ev) { 
        var date = $(this).val();
        window.location.href = "<?php echo site_url() ?>dailydogmedication?date="+date;
});

    $('.drag').draggable ({
        cursor: "move",
        appendTo: ".custom_homepage_cell",
        revert: "invalid",
        opacity: 0.5
    });

    $('.drop').droppable({
        accept: ".drag",
        tolerance: "pointer",
        snap: ".drop",
        drop: function (event, ui) {
            $(this).append(ui.draggable);
            ui.draggable.css({top:0, left:0});
            $(this).css("background-color", "#DEDEDE");

            block_runs();

            var run_num = ui.draggable.parents('.custom_homepage_cell').find('.run_num').val();
            var chart_num = $.trim(ui.draggable.find('.chart_num').text());

            var new_run = new Object();
            new_run.run_num = run_num;
            new_run.chart_num = chart_num;

            var data = JSON.stringify(new_run);

            //console.log(data);
            
            $.ajax({
            url: "<?php echo site_url('doghome')?>/change_run/",
            type: 'POST',
            data        : {'data': data},
            dataType:'JSON',
            success: function (data,response) {
              //alert(response.status);
              //console.log(data);
              $('.replaceable').html(data.RunHtml);
              re_init();
              unblock_runs();
            },
            error: function (error) {
              console.log(error);
              alert("error");
              unblock_runs();
            }

            });

        }
    });


});


    function re_init(){
      $('.drag').draggable ({
          cursor: "move",
          appendTo: ".custom_homepage_cell",
          revert: "invalid",
          opacity: 0.5
      });

      $('.drop').droppable({
          accept: ".drag",
          tolerance: "pointer",
          snap: ".drop",
          drop: function (event, ui) {
              $(this).append(ui.draggable);
              ui.draggable.css({top:0, left:0});
              $(this).css("background-color", "#DEDEDE");

              block_runs();

              var run_num = ui.draggable.parents('.custom_homepage_cell').find('.run_num').val();
              var chart_num = $.trim(ui.draggable.find('.chart_num').text());

              var new_run = new Object();
                new_run.run_num = run_num;
                new_run.chart_num = chart_num;
              var data = JSON.stringify(new_run);

              $.ajax({
              url: "<?php echo site_url('doghome')?>/change_run/",
              type: 'POST',
              data        : {'data': data},
              dataType:'JSON',
              success: function (data,response) {
                //alert(response.status);
                //console.log(data);
                $('.replaceable').html(data.RunHtml);
                re_init();
                unblock_runs();
              },
              error: function (error) {
                //console.log(error);
                //alert("error");
                unblock_runs();
              }

              });

          }
      });
    }

    function block_runs(){
      jQuery(".run_overlay").fadeIn();
    }

    function unblock_runs(){
      jQuery(".run_overlay").fadeOut();
    }

</script>
 
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
         <h1>Dog Home</h1>
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
                 <a href="#" class="date_search">Search for vaccinations on a specific date</a>
                 <input style="height:0px;width:0px;float:left;display:inline;background:transparent;"value="" type="text" size="20" id="search_date" name="search_date" class="datepicker form-control" data-date-format="yyyy-mm-dd"/>
            </div>
          </div>

          <div style="width:100%;float:right;clear:both;">
            <div class="form-group">
                 <a href="#" class="date_search_2">Search for medications due on a specific date</a>
                 <input style="height:0px;width:0px;float:left;display:inline;background:transparent;"value="" type="text" size="20" id="search_date_2" name="search_date_2" class="datepicker form-control" data-date-format="yyyy-mm-dd"/>
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

        </div>

        <div class="table-responsive" style="clear:both;">  
        <table class="table table-striped">
          <caption>Latest Dog Additions</caption>
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

        <div class="replaceable">
        <?php if(isset($custom_homepage_details)) {
        $json = json_decode($custom_homepage_json[0]['sections_json'],true);
        $i = 1;
        $current_section_count = 1;
        while( $i <= $custom_homepage_sections[0]['sections'] ){
        ?>
        <div class="custom_homepage_table_wrap" style="position:relative;">
        <div class="run_overlay" style="display:none;position:absolute;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.45);background: url(data:;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAABl0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuNUmK/OAAAAATSURBVBhXY2RgYNgHxGAAYuwDAA78AjwwRoQYAAAAAElFTkSuQmCC) repeat scroll transparent\9; /* ie fallback png background image */z-index:9999;color:white;"></div> 
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
                  <td class="drop custom_homepage_cell">
                  <input type="hidden" class="run_num" value="<?=$run['id']?>"/>
                  <span style="width:100%;display:block;background-color: #d2d2d2;color: black;font-weight: bold;text-transform: uppercase;padding: 5px;"> <?= $run['name']?></span>
                  <?php
                    foreach($allanimals as $animal){
                      if($animal['run_num'] == $run['id']){
                  ?>   
                      <div class="drag" style="<?php foreach($colorandstatus as $color){if($run['id'] == $color['animal_run_num'] && $animal['chart_num'] == $color['animal_chart_num']){ echo 'background-color:'.$color['color'].';color:white;'; }}?>">
                        <span><?=$animal['name']?> - <a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a></span>
                        <br/>
                        <span>Status : <?=$animal['status']?></span>
                        <br/>
                        <span>Chart Number : <span class="chart_num"><?=$animal['chart_num']?></span></span>
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
      </div>

      </div>
   </div>