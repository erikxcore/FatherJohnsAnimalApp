    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add An Animal</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('addanimal'); ?>
    
<div class="form-group">
     <label for="name">Name:</label>
     <input type="text" size="20" id="name" name="name" class="form-control"  value="<?php echo set_value('name'); ?>"/>
</div>

<div class="form-group">
     <label for="chart_num">Chart Number:</label>
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
     <label for="species">Species:</label>
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

<div class="form-group">
     <label for="date_of_arrival">Date Of Arrival:</label>
     <input type="text" size="20" id="date_of_arrival" name="date_of_arrival" class="datepicker form-control" data-date-format="mm/dd/yyyy"  value="<?php echo set_value('date_of_arrival'); ?>"/>
</div>

<div class="form-group">
     <label for="acquired">Acquired By:</label>
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
      <label for="sex">Sex:</label>
        <select name="sex" id="sex" class="form-control">
          <option selected="selected" value="">Sex</option>
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
        <label for="status">Status:</label>
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
     <label for="status_date">Status Date:</label>
     <input type="text" size="20" id="status_date" name="status_date" class="datepicker form-control" data-date-format="mm/dd/yyyy"  value="<?php echo set_value('status_date'); ?>"/>
</div>

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


     <p>Note - To add weight history and vaccination history please first add the animal and edit their entry later.</p>

    <input class="btn btn-success" type="submit" value="Add Animal"/>
   </form>

 </div>