    <div class="container theme-showcase" role="main">

    <div class="page-header">
      <!--  <h1>Add A Vaccination Record</h1>  -->
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

          <?php
             $i = 0;
            foreach($vaccinations as $vaccination) { ?>

        <div class="form-group">
             <label for="vac_name_<?=$i?>">Vaccination Name:</label>
             <input readonly type="text" size="20" id="vac_name_<?=$i?>" name="vac_name_<?=$i?>" class="form-control" value="<?php echo $vaccination['name']; ?>"/>
        </div>

        <div class="checkbox">
            <label>
              <input value="enabled" type="checkbox" name="vac_check_<?=$i?>" id="vac_check_<?=$i?>"> Enabled?
            </label>
        </div>

        <div class="form-group">
             <label for="date_given_<?=$i?>">Date Given:</label>
             <input value="<?php echo set_value('date_given_<?=$i?>'); ?>" type="text" size="20" id="date_given_<?=$i?>" name="date_given_<?=$i?>" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <div class="form-group">
             <label for="date_completed_<?=$i?>">Date Completed:</label>
             <input value="<?php echo set_value('date_completed_<?=$i?>'); ?>" type="text" size="20" id="date_completed_<?=$i?>" name="date_completed_<?=$i?>" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <?php $i++; } ?>

     <input class="btn btn-success" type="submit" value="Add Vaccination"/>
   </form>

 </div>