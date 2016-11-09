    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add A Medication Record</h1>
    </div>
    
    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addmedication' .'/'.$animal[0]['chart_num']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Name:</label>
           <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="med_name">Medication Name:</label>
           <input type="text" size="20" id="med_name" name="med_name" class="form-control" value="<?php echo set_value('med_name'); ?>"/>
      </div>


      <div class="form-group">
           <label for="med_notes">Medical Notes:</label>
           <textarea rows="5" size="100" id="med_notes" name="med_notes"  class="form-control"><?php echo set_value('med_notes'); ?></textarea>
      </div>

      <div class="form-group">
           <label for="med_dose">Dose:</label>
           <input type="text" size="20" id="med_dose" name="med_dose" class="form-control" value="<?php echo set_value('med_dose'); ?>"/>
      </div>

      <div class="form-group">
           <label for="med_duration">Duration:</label>
           <input type="text" size="20" id="med_duration" name="med_duration" class="form-control" value="<?php echo set_value('med_duration'); ?>"/>
      </div>


        <div class="form-group">
             <label for="date_given">Date Started:</label>
             <input value="<?php echo set_value('date_given'); ?>" type="text" size="20" id="date_given" name="date_given" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <div class="form-group">
             <label for="date_due">Date Completed:</label>
             <input value="<?php echo set_value('date_due'); ?>" type="text" size="20" id="date_due" name="date_due" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

     <input class="btn btn-success" type="submit" value="Add Medication"/>
   </form>

 </div>