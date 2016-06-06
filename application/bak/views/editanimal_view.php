    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Animal</h1>
    </div>

    <a href="javascript:history.back()">Go Back</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('editanimal' .'/'.$animal[0]['chart_num']); ?>
    <?php if(empty($animal)){
      echo 'There was a problem retrieving your animal.';
    }?>
    
      <p>Last modified by <?=$animal[0]['user']?> on <?=$animal[0]['user_date']?> </p>

<div class="form-group">
     <label for="name">Name:</label>
     <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
</div>

<div class="form-group">
     <label for="chart_num">Chart Number:</label>
     <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
</div>

<div class="form-group">
        <label for="status">Run Number:</label>
        <select name="run_num" id="run_num" class="form-control">
          <option selected="selected" value="">Select a Run</option>
          <option value="">N/A</option>
          <?php
            foreach($runs as $run) { ?>
              <option  value="<?= $run['id'] ?>" <?php if($animal[0]['run_num'] == $run['id']) { ?>selected<?php } ?> ><?= $run['name'] ?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="species">Species:</label>
        <select name="species" id="species" class="form-control">
          <option value="">Choose a species</option>
          <?php
            foreach($allspecies as $specie) { ?>
              <option <?php if($animal[0]['species'] == $specie['name']){?>selected="selected"<?php }?> value="<?= $specie['name'] ?>"><?= $specie['name'] ?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="breed">Breed:</label>
     <input type="text" size="20" id="breed" name="breed" class="form-control" value="<?=$animal[0]['breed']?>"/>
</div>

<div class="form-group">
     <label for="date_of_arrival">Date Of Arrival:</label>
     <input value="<?php $timestamp = strtotime($animal[0]['date_of_arrival']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>
 "type="text" size="20" id="date_of_arrival" name="date_of_arrival" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
</div>

<div class="form-group">
     <label for="acquired">Acquired By:</label>
        <select name="acquired" id="acquired" class="form-control">
          <option value="">How was this animal acquired?</option>
          <?php
            foreach($acquired_method as $method) { ?>
              <option <?php if($animal[0]['acquired'] == $method['name']){?>selected="selected"<?php }?> value="<?= $method['name'] ?>"><?= $method['name'] ?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="acquired_how">Acquired Notes:</label>
     <textarea rows="5" size="100" id="acquired_how" name="acquired_how" class="form-control"><?=$animal[0]['acquired_how']?></textarea>
</div>

<div class="form-group">
     <label for="microchip_num">Microchip Number:</label>
     <input value="<?=$animal[0]['microchip_num']?>" type="text" size="20" id="microchip_num" name="microchip_num" class="form-control"/>
</div>

<div class="form-group">
     <label for="age">Age:</label>
     <input value="<?=$animal[0]['age']?>"type="text" size="20" id="age" name="age" class="form-control"/>
</div>

<div class="form-group">
      <label for="sex">Sex:</label>
        <select name="sex" id="sex" class="form-control">
          <option value="">Sex</option>
          <?php
            foreach($genders as $gender) { ?>
              <option <?php if($animal[0]['sex'] == $gender['name']){?>selected="selected"<?php }?>value="<?= $gender['name'] ?>"><?= $gender['name'] ?></option>
          <?php
            } ?>
        </select>
</div>

<div class="form-group">
     <label for="feeding_instructions">Feeding Instructions:</label>
     <textarea rows="5" size="100" id="feeding_instructions" name="feeding_instructions" class="form-control"><?=$animal[0]['feeding_instructions']?></textarea>
</div>

<div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control">
          <option value="">Select a Status</option>
          <?php
            foreach($statuses as $status) { ?>
              <option <?php if($animal[0]['status'] == $status['name']){?>selected="selected"<?php }?> value="<?= $status['name'] ?>"><?= $status['name'] ?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="status_date">Status Date:</label>
     <input value="<?php $timestamp = strtotime($animal[0]['status_date']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="status_date" name="status_date" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
</div>

<div class="form-group">
     <label for="behavior_strategy">Behavior Strategy:</label>
     <textarea rows="5" size="100" id="behavior_strategy" name="behavior_strategy" class="form-control"><?=$animal[0]['behavior_strategy']?></textarea>
</div>

<div class="form-group">
      <label for="sex">SAFER Completed:</label>
        <select name="safer_complete" id="safer_complete" class="form-control">
              <option <?php if(strtolower($animal[0]['safer_complete']) == strtolower("Yes")){?> selected="selected" <?php } ?> value="yes">Yes</option>
              <option <?php if(strtolower($animal[0]['safer_complete']) == strtolower("No")){?> selected="selected" <?php } ?> value="no">No</option>
        </select>
</div>

<div class="form-group">
     <label for="notes">Notes:</label>
     <textarea rows="5" size="100" id="notes" name="notes"  class="form-control"><?=$animal[0]['notes']?></textarea>
</div>

<?php if($animal[0]['picture'] == null ){ ?>
<div class="form-group">
     <label for="picture">Picture:</label>
     <input class="form-control" name="picture" id="picture" type="file">
</div>
<?php }else{ ?>
     <img src="<?=$animal[0]['picture']?>"/>
     <a href="removepicture/<?=$animal[0]['chart_num']?>">Remove Picture</a><br/>
<?php } ?>

<?php
if(!empty($weights)){
?>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Weight</th>
        <th>Date Measured</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($weights as $weight) { ?>
  <tr>
    <td><?=$weight['weight']?></td>
    <td><?php $timestamp = strtotime($weight['date']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><a href="<?php echo site_url('editweight').'/'.$animal[0]['chart_num'] .'/'.$weight['id']?>">Edit Weight</a></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>

<!--
<?php
if(!empty($medications)){
?>
  <p>Medications</p>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date Given</th>
        <th>Date Due</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($medications as $medication) { ?>
  <tr>
    <td><?=$medication['name']?></td>
    <td><?php $timestamp = strtotime($medication['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><?php $timestamp = strtotime($medication['date_due']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><a href="<?php echo site_url('editmedication').'/'.$animal[0]['chart_num'] .'/'.$medication['id']?>">Edit</a></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>
-->

<?php
if(!empty($vaccinations)){
?>
  <p>Vaccinations</p>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date Given</th>
        <th>Date Completed</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($vaccinations as $vaccination) { ?>
  <tr>
    <td><?=$vaccination['name']?></td>
    <td><?php $timestamp = strtotime($vaccination['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><?php if($vaccination['date_completed'] != null){$timestamp = strtotime($vaccination['date_completed']);$dmy = date("m/d/Y", $timestamp);echo $dmy;}?></td>
    <td><a href="<?php echo site_url('editvaccination').'/'.$animal[0]['chart_num'] .'/'.$vaccination['id']?>">Edit</a></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>

<!--
<?php
if(!empty($safer_results)){
?>
<h4>SAFER Results</h4>
<ul>
<li>Test 1: <?=$safer_results[0]['test_1']?></li>
<li>Test 2: <?=$safer_results[0]['test_2']?></li>
<li>Test 3: <?=$safer_results[0]['test_3']?></li>
<li>Test 4: <?=$safer_results[0]['test_4']?></li>
<li>Test 5: <?=$safer_results[0]['test_5']?></li>
<li>Test 6: <?=$safer_results[0]['test_6']?></li>
<li>Test 7: <?=$safer_results[0]['test_7']?></li>
</ul>
<?php } ?>
-->

<a href="<?php echo site_url('addweight').'/'.$animal[0]['chart_num']; ?>">Add Weight Check-In</a><br/>
<?php
if(!empty($weights)){ 
?>
<a href="<?php echo site_url('removeweight').'/'.$animal[0]['chart_num']; ?>">Remove a Weight Check-In</a><br/>
<?php }?>
<a href="<?php echo site_url('addvaccination').'/'.$animal[0]['chart_num']; ?>">Add Vaccination</a><br/>
<?php
if(!empty($vaccinations)){
?>
<a href="<?php echo site_url('removevaccination').'/'.$animal[0]['chart_num']; ?>">Remove a Vaccination</a><br/>
<?php }?>
<!--
<a href="<?php echo site_url('addmedication').'/'.$animal[0]['chart_num']; ?>">Add Medication</a><br/>
-->
<!--
<?php
if(!empty($medications)){
?>
<a href="<?php echo site_url('removemedication').'/'.$animal[0]['chart_num']; ?>">Remove a Medication</a><br/>
<?php }?>
-->
<!--
<?php if($animal[0]['safer_complete'] != 1 ) { ?>
<a href="<?php echo site_url('addsafer').'/'.$animal[0]['chart_num']; ?>">Add SAFER results</a><br/>
<?php } ?>
<?php
if(!empty($safer_results)){
?>
<a href="<?php echo site_url('editsafer').'/'.$animal[0]['chart_num']; ?>">Edit SAFER results</a><br/>
<a href="<?php echo site_url('removesafer').'/'.$animal[0]['chart_num']; ?>">Remove SAFER results</a><br/>
<?php }?>
-->

<input class="btn btn-success" type="submit" value="Edit Animal"/></br>

<?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>
    <a class="btn btn-error" href="delete_animal/<?=$animal[0]['chart_num'];?>">Delete Animal</a>
<?php } ?> 

   </form>
 </div>