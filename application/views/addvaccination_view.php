    <script type="text/javascript">
      $('#vacTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show');
      })

      $( document ).ready(function() {
        $('form').on('submit', function(e) {
                e.preventDefault();
                generateJson();
                if(window.confirm("Are you sure you wish to make this change?")){
                  this.submit();
                }
        });
      });

      function generateJson(){
        

        $('.tab-pane').each(function(index){
          var counter = $(this).find('.counter').val();

          //console.log("Processing " + counter);

          if( $(this).find('.vac_num').val() != null && $(this).find('.vac_num').val() != "" && $(this).find('.vac_by').val() != null && $(this).find('.vac_by').val() != ""){
            var generated = null;
            var iterator = $(this).find('.vac_by').val();
            var amount = $(this).find('.vac_num').val();
         
          generated = '{"series" : [';
          generated += '{"iterator":"'+iterator+'","amount":"'+amount+'"}';
          generated += '] }';

          //console.log("Generated JSON:" + generated);

          $('.vac_series_'+counter).val(generated);

           }
        });

      }

    </script>
    <div class="container theme-showcase" role="main">

    <div class="page-header">
      <h1>Add A Vaccination Record</h1>
    </div>
    
    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addvaccination' .'/'.$animal[0]['chart_num']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Name:</label>
           <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
      </div>

  <ul class="nav nav-tabs" role="tablist">
    <?php  foreach($vaccinations as $vaccination) {
        $name = str_replace(array('.', ' ', '/'), '_', $vaccination['name']);

    ?>
      <li role="presentation"><a href="#<?php echo $name; ?>" aria-controls="<?php echo $name; ?>" role="tab" data-toggle="tab"><?php echo $vaccination['name']; ?></a></li>
    <?php } ?>
  </ul>

  <p>Note - you can enable multiple vaccinations at once by clicking on the given check box and selecting another test.</p>

  <div class="tab-content">
          <?php
             $i = 0;
            foreach($vaccinations as $vaccination) { 
            $name = str_replace(array('.', ' ', '/'), '_', $vaccination['name']);

            ?>
               <div role="tabpanel" class="tab-pane" id="<?php echo $name; ?>">
                  <input type="hidden" name="counter" class="counter" value="<?=$i?>"/>  

                  <div class="form-group">
                       <label for="vac_name_<?=$i?>">Vaccination Name:</label>
                       <input readonly type="text" size="20" id="vac_name_<?=$i?>" name="vac_name_<?=$i?>" class="form-control" value="<?php echo $vaccination['name']; ?>"/>
                  </div>

                  <div class="checkbox">
                      <label>
                        <input value="enabled" type="checkbox" name="vac_check_<?=$i?>" id="vac_check_<?=$i?>"> Given to Animal?
                      </label>
                  </div>

                  <div class="form-group">
                       <label for="vac_notes_<?=$i?>">Notes:</label>
                       <textarea rows="5" size="100" id="vac_notes_<?=$i?>" name="vac_notes_<?=$i?>"  class="form-control"></textarea>
                  </div>

                  <div class="form-group">
                          <label for="vac_source_<?=$i?>">Source:</label>
                          <select name="vac_source_<?=$i?>" id="vac_source_<?=$i?>" class="form-control">
                            <option selected="selected" value="Father Johns">Father Johns</option>
                            <option value="External">External</option>
                          </select> 
                  </div>

                  <div class="form-group">
                       <label for="date_given_<?=$i?>">Date Due:</label>
                       <input value="<?php echo set_value('date_given_<?=$i?>'); ?>" type="text" size="20" id="date_given_<?=$i?>" name="date_given_<?=$i?>" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
                  </div>

                  <div class="form-group">
                       <label for="date_completed_<?=$i?>">Date Given:</label>
                       <input value="<?php echo set_value('date_completed_<?=$i?>'); ?>" type="text" size="20" id="date_completed_<?=$i?>" name="date_completed_<?=$i?>" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
                  </div>


                  <div class="form-group">
                     <input type="hidden" name="vac_series_<?=$i?>" id="vac_series_<?=$i?>" class="vac_series_<?=$i?>"/>
                          <h6>If not a series this information does not need to be entered.</h6>
                          <h6>Note, you will have to manually update the date given when vaccination has been given to automatically create the next vaccination in the series or remove the homepage overdue warning.</h6>
                          <label for="vac_num_<?=$i?>">Series Every:</label>
                          <input type="number" size="20" id="vac_num_<?=$i?>" name="vac_num_<?=$i?>" class="form-control vac_num" value=""/>

                          <label for="vac_by_<?=$i?>">Series By:</label>
                          <select name="vac_by_<?=$i?>" id="vac_by_<?=$i?>" class="form-control vac_by">
                            <option selected="selected" value="">N/A</option>
                            <option value="days">Day</option>
                            <option value="months">Month</option>
                            <option value="weeks">Week</option>
                            <option value="years">Year</option>
                          </select>
                  
                  </div>




              </div>

        <?php $i++; } ?>
</div>
  
  <br/>
  <br/>
     <input class="btn btn-success" type="submit" value="Add Vaccination"/>
   </form>

 </div>