<script type="text/javascript">
$( document ).ready(function() { 
  $("#add_animal").on("submit", function(e){
    var isValid = false;
    var tab1Valid = false;
    var tab2Valid = false;

    $('.errors').html('');

    var nameLength = $('#name').val().length;
    var chartLength = $('#chart_num').val().length;
    var speciesLength = $('#species').val().length;
    var dateOfArrivalLength = $('#date_of_arrival').val().length;
    var acquiredLength = $('#acquired').val().length;
    var sexLength = $('#sex').val().length;
    var statusLength = $('#status').val().length;
    var statusDateLength = $('#status_date').val().length;

    if(nameLength == 0){
      $('.errors').append('<p>Please enter a name.</p>');
    }

    if(chartLength == 0){
      $('.errors').append('<p>Please enter a chart number.</p>');
    }

    if(speciesLength == 0){
      $('.errors').append('<p>Please select a species.</p>');
    }

    if (nameLength > 0 && chartLength > 0 && speciesLength > 0) tab1Valid = true;

    if(dateOfArrivalLength == 0){
      $('.errors').append('<p>Please enter the date of arrival.</p>');
    }

    if(acquiredLength == 0){
      $('.errors').append('<p>Please select an acquired by method.</p>');
    }

    if(sexLength == 0){
      $('.errors').append('<p>Please select a gender.</p>');
    }

    if(statusLength == 0){
      $('.errors').append('<p>Please select a status.</p>');
    }

    if(statusDateLength == 0){
      $('.errors').append('<p>Please select a status date.</p>');
    }

    if (dateOfArrivalLength > 0 &&  acquiredLength > 0 && sexLength > 0 && statusLength > 0 && statusDateLength > 0) tab2Valid = true;

    if(tab1Valid && !tab2Valid){
      $('.nav li').removeClass('active');
      $('.tab-content .tab-pane').removeClass('active');

      $('.nav li a[href=#rescue]').parent('li').addClass('active');
      $('#rescue').addClass("active");

    }else if(!tab1Valid && tab2Valid){
      $('.nav li').removeClass('active');
      $('.tab-content .tab-pane').removeClass('active');

      $('.nav li a[href=#general]').parent('li').addClass('active');
      $('#general').addClass("active");

    }else if(!tab1Valid && !tab2Valid){
      $('.nav li').removeClass('active');
      $('.tab-content .tab-pane').removeClass('active');

      $('.nav li a[href=#general]').parent('li').addClass('active');
      $('#general').addClass("active");
    }

    if(nameLength > 0 && chartLength > 0 && speciesLength > 0 && dateOfArrivalLength > 0 &&  acquiredLength > 0 && sexLength > 0 && statusLength > 0 && statusDateLength > 0){
      isValid = true;
    }


    if (!isValid){ 
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    }
       
  });
});
</script>

    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add An Animal</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <div class="errors">
    <?php echo validation_errors(); ?>
    </div>
    <?php $attributes = array('id' => 'add_animal'); ?>
    <?php echo form_open_multipart('addanimal', $attributes); ?>

      <ul class="nav nav-pills" role="tablist">
      <li role="presentation" class="active"><a href="#general"  aria-controls="general" role="tab" data-toggle="tab">Basic Info</a></li>
      <li role="presentation"><a href="#rescue" aria-controls="rescue" role="tab" data-toggle="tab">Rescue Info</a></li>
      <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes, Behavior, &amp; SAFER Info</a></li>
      </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="general">      
    
<div class="form-group">
     <label for="name"><span class="required">*</span>Name:</label>
     <input type="text" size="20" id="name" name="name" class="form-control"  value="<?php echo set_value('name'); ?>"/>
</div>

<div class="form-group">
     <label for="chart_num"><span class="required">*</span>Chart Number:</label>
     <input type="text" size="20" id="chart_num" name="chart_num" class="form-control"  value="<?php echo set_value('chart_num'); ?>"/>
</div>



<div class="form-group">
        <label for="status">Run Number:</label>
        <select name="run_num" id="run_num" class="form-control">
          <option selected="selected" value="">Select a Run</option>
          <option value="">N/A</option>
          <?php
            foreach($runs as $run) { ?>
              <option  value="<?= $run['id'] ?>" <?php echo set_select('run_num', $run['id']); ?> ><?= $run['name'] ?></option>
          <?php
            } ?>
        </select> 
</div>


<div class="form-group">
     <label for="species"><span class="required">*</span>Species:</label>
        <select name="species" id="species" class="form-control">
          <option selected="selected" value="">Choose a species</option>
          <?php
            foreach($allspecies as $specie) { ?>
              <option value="<?= $specie['name'] ?>" <?php echo set_select('species', $specie['name']); ?> > <?= $specie['name']?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="breed">Breed:</label>
     <input type="text" size="20" id="breed" name="breed" class="form-control"  value="<?php echo set_value('breed'); ?>"/>
</div>

      </div>
      <div role="tabpanel" class="tab-pane" id="rescue">

<div class="form-group">
     <label for="date_of_arrival"><span class="required">*</span>Date Of Arrival:</label>
     <input type="text" size="20" id="date_of_arrival" name="date_of_arrival" class="datepicker form-control" data-date-format="mm/dd/yyyy"  value="<?php echo set_value('date_of_arrival'); ?>"/>
</div>

<div class="form-group">
     <label for="acquired"><span class="required">*</span>Acquired By:</label>
        <select name="acquired" id="acquired" class="form-control">
          <option selected="selected" value="">How was this animal acquired?</option>
          <?php
            foreach($acquired_method as $method) { ?>
              <option value="<?= $method['name'] ?>" <?php echo set_select('acquired', $method['name']); ?> ><?= $method['name']?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="acquired_how">Acquired Notes:</label>
     <textarea rows="5" size="100" id="acquired_how" name="acquired_how" class="form-control"><?php echo set_value('acquired_how'); ?></textarea>
</div>

<div class="form-group">
     <label for="microchip_num">Microchip Number:</label>
     <input type="text" size="20" id="microchip_num" name="microchip_num" class="form-control"  value="<?php echo set_value('microchip_num'); ?>"/>
</div>

<div class="form-group">
     <label for="age">Age:</label>
     <input type="text" size="20" id="age" name="age" class="form-control"  value="<?php echo set_value('age'); ?>"/>
</div>

<div class="form-group">
      <label for="sex"><span class="required">*</span>Sex:</label>
        <select name="sex" id="sex" class="form-control">
          <option selected="selected" value="">Select a sex</option>
          <?php
            foreach($genders as $gender) { ?>
              <option  value="<?= $gender['name'] ?>" <?php echo set_select('sex', $gender['name']); ?>><?= $gender['name']?></option>
          <?php
            } ?>
        </select>
</div>

<div class="form-group">
     <label for="feeding_instructions">Feeding Instructions:</label>
     <textarea rows="5" size="100" id="feeding_instructions" name="feeding_instructions" class="form-control"><?php echo set_value('feeding_instructions'); ?></textarea>
</div>

<div class="form-group">
        <label for="status"><span class="required">*</span>Status:</label>
        <select name="status" id="status" class="form-control">
          <option selected="selected" value="">Select a Status</option>
          <?php
            foreach($statuses as $status) { ?>
              <option  value="<?= $status['name'] ?>" <?php echo set_select('status', $status['name']); ?> ><?= $status['name'] ?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="status_date"><span class="required">*</span>Status Date:</label>
     <input type="text" size="20" id="status_date" name="status_date" class="datepicker form-control" data-date-format="mm/dd/yyyy"  value="<?php echo set_value('status_date'); ?>"/>
</div>


        </div>
        <div role="tabpanel" class="tab-pane" id="notes">

<div class="form-group">
     <label for="behavior_strategy">Behavior Strategy:</label>
     <textarea rows="5" size="100" id="behavior_strategy" name="behavior_strategy" class="form-control"><?php echo set_value('behavior_strategy'); ?></textarea>
</div>

<div class="form-group">
      <label for="sex">SAFER Completed:</label>
        <select name="safer_complete" id="safer_complete" class="form-control">
              <option value="no">No</option>
              <option value="yes">Yes</option>
        </select>
</div>

<div class="form-group">
     <label for="notes">Notes:</label>
     <textarea rows="5" size="100" id="notes" name="notes"  class="form-control"><?php echo set_value('notes'); ?></textarea>
</div>


<div class="form-group">
     <label for="picture">Picture:</label>
     <input class="form-control" name="picture" id="picture" type="file">
</div>

<div class="form-group">
     <label for="medical_notes">Vet Notes:</label>
     <textarea rows="5" size="100" id="medical_notes" name="medical_notes"  class="form-control"><?php echo set_value('medical_notes'); ?></textarea>
</div>

        </div>
      </div>

     <p>Note - To add weight history and vaccination history please first add the animal and edit their entry later.</p>
     <p>Be sure to click on Rescue information and fill out the required fields!</p>

    <input class="btn btn-success" type="submit" value="Add Animal"/>
   </form>

 </div>