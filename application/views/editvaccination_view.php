<script type="text/javascript">
      $( document ).ready(function() {
        loadJson();
        $('form').on('submit', function(e) {
                e.preventDefault();
                generateJson();
                if(window.confirm("Are you sure you wish to make this change?")){
                  this.submit();
                }
        });
      });

      function generateJson(){

          if( $('.vac_num').val() != null && $('.vac_num').val() != "" && $('.vac_by').val() != null && $('.vac_by').val() != ""){
            var generated = null;
            var iterator = $('.vac_by').val();
            var amount = $('.vac_num').val();
         
          generated = '{"series" : [';
          generated += '{"iterator":"'+iterator+'","amount":"'+amount+'"}';
          generated += '] }';

          //console.log("Generated JSON:" + generated);

          $('.vac_series').val(generated);

           }else{
            $('.vac_series').val('');
           }
      }

      function loadJson(){
        var json = $(".vac_series_old").val();

        console.log("Old series JSON:" + json);

        try{
            var jobj = $.parseJSON(json);
            //console.log("JSON generated object loaded:");
            //console.log(jobj);

            //console.log(jobj.series[0].amount);

            var vac_by = jobj.series[0].iterator;
            var vac_num = jobj.series[0].amount;

            $('.vac_num').val(vac_num);
            $('.vac_by').val(vac_by);

        }catch(err){
          console.log("Previous series generated was not valid JSON or was not a series.");
        }

      }

</script>

    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Animal Vaccination Record</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editvaccination' .'/'.$animal[0]['chart_num'] .'/'.$vaccination[0]['id']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$vaccination[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="vac_name">Vaccination Name:</label>
           <input readonly type="text" size="20" id="vac_name" name="vac_name" class="form-control" value="<?=$vaccination[0]['name']?>"/>
      </div>

        <div class="form-group">
             <label for="vac_notes">Notes:</label>
             <textarea rows="5" size="100" id="vac_notes" name="vac_notes"  class="form-control"><?=$vaccination[0]['notes']?></textarea>
        </div>

        <div class="form-group">
                <label for="vac_source">Source:</label>
                <select name="vac_source" id="vac_source" class="form-control">
                  <option <?php if(strtolower($vaccination[0]['source']) == strtolower("father johns")){?> selected="selected" <?php } ?> value="Father Johns">Father Johns</option>
                  <option <?php if(strtolower($vaccination[0]['source']) == strtolower("external")){?> selected="selected" <?php } ?> value="External">External</option>
                </select> 
        </div>

        <div class="form-group">
             <label for="date">Date Due:</label>
             <input value="<?php $timestamp = strtotime($vaccination[0]['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="date_given" name="date_given" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <div class="form-group">
             <label for="date">Date Given:</label>
             <input value="<?php if($vaccination[0]['date_completed'] != null){ $timestamp = strtotime($vaccination[0]['date_completed']);$dmy = date("m/d/Y", $timestamp);echo $dmy; }?>" type="text" size="20" id="date_completed" name="date_completed" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

                  <div class="form-group">
                    <input type="hidden" value="<?=htmlspecialchars($vaccination[0]['series'])?>" name="vac_series_old" id="vac_series_old" class="vac_series_old"/>

                     <input type="hidden" name="vac_series" id="vac_series" class="vac_series"/>
                          <h6>If not a series this information does not need to be entered.</h6>
                          <h6>Note, you will have to manually update the date given when vaccination has been given to automatically create the next vaccination in the series or remove the homepage overdue warning.</h6>
                          <label for="vac_num">Series Every:</label>
                          <input type="number" size="20" id="vac_num" name="vac_num" class="form-control vac_num" value=""/>

                          <label for="vac_by">Series By:</label>
                          <select name="vac_by" id="vac_by" class="form-control vac_by">
                            <option selected="selected" value="">N/A</option>
                            <option value="days">Day</option>
                            <option value="months">Month</option>
                            <option value="weeks">Week</option>
                            <option value="years">Year</option>
                          </select>
                  
                  </div>

     <input class="btn btn-success" type="submit" value="Edit Vaccination"/>
   </form>

 </div>