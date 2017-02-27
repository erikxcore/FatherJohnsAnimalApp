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