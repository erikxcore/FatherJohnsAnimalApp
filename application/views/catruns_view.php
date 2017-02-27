        <?php if(isset($custom_homepage_details)) { ?>
        <div class="other_runs" style="position:relative;">
          <div class="run_overlay" style="display:none;position:absolute;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.45);background: url(data:;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAABl0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuNUmK/OAAAAATSURBVBhXY2RgYNgHxGAAYuwDAA78AjwwRoQYAAAAAElFTkSuQmCC) repeat scroll transparent\9; /* ie fallback png background image */z-index:9999;color:white;"></div> 
          <?php
            foreach( $other_runs as $run){
          ?>
          <h4><?=$run['name']?></h4>
          <div class="table-responsive">
            <table class="table drop" style="min-height:20px;">
             <input type="hidden" class="run_num" value="<?=$run['id']?>"/>
          <?php
                foreach($allanimals as $animal){
                  if($animal['run_num'] == $run['id']){
          ?>
                      <tr class="drag" colspan="5" style="text-align:center;">
                        <td colspan="2" ><?=$animal['name']?></td>
                        <td colspan="1" style="<?php foreach($colorandstatus as $color){if($run['id'] == $color['animal_run_num'] && $animal['chart_num'] == $color['animal_chart_num']){ echo 'background-color:'.$color['color'].';color:white;'; }}?>">Status : <?=$animal['status']?></td>
                        <td colspan="1" >Chart Number : <span class="chart_num"><?=$animal['chart_num']?></span></td>
                        <td colspan="1" ><a href="<?php echo site_url('displayanimal').'/'.$animal['chart_num'] ?>">View Details</a></td>
                      </tr>
          <?php 
                  }
                }
           ?> </table> </div>
           <?php } ?>
        </div>
        <?php } ?>