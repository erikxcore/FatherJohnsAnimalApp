    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>View An Animal</h1>
    </div>

    <a href="javascript:history.back()">Go Back</a></br>


    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo form_open('displayanimal' .'/'.$animal[0]['chart_num']); ?>
    <?php if(empty($animal)){
      echo 'There was a problem retrieving your animal.';
    }?>

<?php if(isset($animal[0]['user']) && $animal[0]['user'] != "" && $animal[0]['user'] != NULL){ ?>
  <p>Last modified by <?=$animal[0]['user']?> on <?=$animal[0]['user_date']?> </p>
<?php } ?>

<div class="form-group" style="display:none;">
     <a href="getcontract/<?=$animal[0]['chart_num']?>" target="_blank">Adoption Contract PDF</a><br/>
</div>

<div class="form-group">
     <a href="getinfo/<?=$animal[0]['chart_num']?>" target="_blank">Animal Information PDF</a><br/>
</div>

<div class="form-group">
     <label for="name">Name:</label>
     <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
</div>

<div class="form-group">
     <label for="chart_num">Chart Number:</label>
     <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
</div>

<div class="form-group">
        <label for="status">Run Number:</label>
        <select readonly name="run_num" id="run_num" class="form-control">
          <?php
            foreach($runs as $run) { 
              if($animal[0]['run_num'] == $run['id']) { ?>
              <option  value="<?= $run['id'] ?>" selected ><?= $run['name'] ?></option>
          <?php
              }
            } ?>
        </select> 
</div>


<div class="form-group">
     <label for="species">Species:</label>
        <select readonly name="species" id="species" class="form-control">
          <?php
            foreach($allspecies as $specie) { 
              if($animal[0]['species'] == $specie['name']){ ?>
              <option selected="selected" value="<?= $specie['name'] ?>"><?= $specie['name'] ?></option>
          <?php
              }
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="breed">Breed:</label>
     <input readonly type="text" size="20" id="breed" name="breed" class="form-control" value="<?=$animal[0]['breed']?>"/>
</div>

<div class="form-group">
     <label for="date_of_arrival">Date Of Arrival:</label>
     <input disabled readonly value="<?php $timestamp = strtotime($animal[0]['date_of_arrival']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>
 "type="text" size="20" id="date_of_arrival" name="date_of_arrival" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
</div>

<div class="form-group">
     <label for="acquired">Acquired By:</label>
        <select readonly name="acquired" id="acquired" class="form-control">
          <?php
            foreach($acquired_method as $method) { 
               if($animal[0]['acquired'] == $method['name']){?>
              <option selected="selected" value="<?= $method['name'] ?>"><?= $method['name'] ?></option>
          <?php
              }
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="acquired_how">Acquired Notes:</label>
     <textarea readonly rows="5" size="100" id="acquired_how" name="acquired_how" class="form-control"><?=$animal[0]['acquired_how']?></textarea>
</div>

<div class="form-group">
     <label for="microchip_num">Microchip Number:</label>
     <input readonly value="<?=$animal[0]['microchip_num']?>" type="text" size="20" id="microchip_num" name="microchip_num" class="form-control"/>
</div>

<div class="form-group">
     <label for="age">Date of Birth or Age:</label>
     <input disabled readonly value="<?=$animal[0]['age']?>"type="text" size="20" id="age" name="age" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
</div>

<div class="form-group">
      <label for="sex">Sex:</label>
        <select readonly name="sex" id="sex" class="form-control">
          <?php
            foreach($genders as $gender) { 
              if($animal[0]['sex'] == $gender['name']){?>
              <option selected="selected" value="<?= $gender['name'] ?>"><?= $gender['name'] ?></option>
          <?php
              }
            } ?>
        </select>
</div>

<div class="form-group">
     <label for="feeding_instructions">Feeding Instructions:</label>
     <textarea readonly ows="5" size="100" id="feeding_instructions" name="feeding_instructions" class="form-control"><?=$animal[0]['feeding_instructions']?></textarea>
</div>

<div class="form-group">
        <label for="status">Status:</label>
        <select readonly name="status" id="status" class="form-control">
          <?php
            foreach($statuses as $status) { 
              if($animal[0]['status'] == $status['name']){?>
            ?>
              <option selected="selected" value="<?= $status['name'] ?>"><?= $status['name'] ?></option>
          <?php
              }
            } ?>
        </select> 
</div>

<div class="form-group">
     <label for="status_date">Status Date:</label>
     <input disabled readonly value="<?php $timestamp = strtotime($animal[0]['status_date']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="status_date" name="status_date" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
</div>

<div class="form-group">
     <label for="behavior_strategy">Behavior Strategy:</label>
     <textarea readonly rows="5" size="100" id="behavior_strategy" name="behavior_strategy" class="form-control"><?=$animal[0]['behavior_strategy']?></textarea>
</div>

<div class="form-group">
      <label for="sex">SAFER Completed:</label>
        <select readonly name="safer_complete" id="safer_complete" class="form-control">
          <?php
            if(strtolower($animal[0]['safer_complete']) == strtolower("Yes")){?>
              <option selected="selected" value="yes">Yes</option>
          <?php
            }else{?>
              <option selected="selected" value="no">No</option>
            <?php } ?>
        </select>
</div>

<div class="form-group">
     <label for="notes">Notes:</label>
     <textarea readonly rows="5" size="100" id="notes" name="notes"  class="form-control"><?=$animal[0]['notes']?></textarea>
</div>

<?php if($animal[0]['picture'] != null ){ ?>
<div class="form-group">
     <img class="animalImage" src="<?=$animal[0]['picture']?>"/><br/>
</div>
<?php } ?>

<div class="form-group">
     <label for="medical_notes">Medical Notes:</label>
     <textarea readonly rows="5" size="100" id="medical_notes" name="medical_notes"  class="form-control"><?=$animal[0]['medical_notes']?></textarea>
</div>


<?php
if(!empty($weights)){
?>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Weight</th>
        <th>Date Measured</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($weights as $weight) { ?>
  <tr>
    <td><?=$weight['weight']?></td>
    <td><?php $timestamp = strtotime($weight['date']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>


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
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($medications as $medication) { ?>
  <tr>
    <td><?=$medication['name']?></td>
    <td><?php $timestamp = strtotime($medication['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><?php $timestamp = strtotime($medication['date_due']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
  </tr>
  <tr>
      <td>Notes:<?=$medication['notes']?></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>

<?php
if(!empty($vaccinations)){
?>
  <p>Vaccinations</p>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date Given</th>
        <th>Date Due</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($vaccinations as $vaccination) { ?>
  <tr>
    <td><?=$vaccination['name']?></td>
    <td><?php $timestamp = strtotime($vaccination['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><?php if($vaccination['date_completed'] != null){$timestamp = strtotime($vaccination['date_completed']);$dmy = date("m/d/Y", $timestamp);echo $dmy;}?></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>

<a href="<?php echo site_url('displaymedicationhistory').'/'.$animal[0]['chart_num']; ?>">View Medication History</a><br/>
<a href="<?php echo site_url('displayvaccinationhistory').'/'.$animal[0]['chart_num']; ?>">View Vaccination History</a><br/>


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

<?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>

</br><a href="<?php echo site_url('editanimal').'/'.$animal[0]['chart_num'] ?>">Edit This Animal</a></br>

<?php } ?>

   </form>
 </div>