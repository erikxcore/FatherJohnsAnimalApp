
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Animal Medication Record</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editmedication' .'/'.$animal[0]['chart_num'] .'/'.$medication[0]['id']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$medication[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="med_name">Medication Name:</label>
           <input readonly type="text" size="20" id="med_name" name="med_name" class="form-control" value="<?=$medication[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="med_notes">Medical Notes:</label>
           <textarea rows="5" size="100" id="med_notes" name="med_notes"  class="form-control"><?php echo $medication[0]['notes'] ?></textarea>
      </div>

      <div class="form-group">
           <label for="med_dose">Dose:</label>
           <input type="text" size="20" id="med_dose" name="med_dose" class="form-control" value="<?=$medication[0]['dose']?>"/>
      </div>

      <div class="form-group">
           <label for="med_duration">Duration:</label>
           <input type="text" size="20" id="med_duration" name="med_duration" class="form-control" value="<?=$medication[0]['duration']?>"/>
      </div>

        <div class="form-group">
             <label for="date_given">Date Given:</label>
             <input value="<?php $timestamp = strtotime($medication[0]['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="date_given" name="date_given" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <div class="form-group">
             <label for="date_due">Date Completed:</label>
             <input value="<?php $timestamp = strtotime($medication[0]['date_due']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="date_due" name="date_due" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

     <input class="btn btn-success" type="submit" value="Edit Medication"/>
   </form>

 </div>