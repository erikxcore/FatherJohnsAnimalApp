<script type="text/javascript">
$(function() {
    $('.confirm').click(function(e) {
        //e.preventDefault();
        if(!window.confirm("Are you sure you want to delete this animal?")){
          return false;
        }else{
          //alert('delete_animal/<?=$animal[0]['chart_num']?>');
          location.href='delete_animal/<?=$animal[0]['chart_num']?>';
        };
    });
});

$( document ).ready(function() { 
  $("#edit_animal").on("submit", function(e){
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
        <h1>Edit An Animal</h1>
    </div>

    <a href="javascript:history.back()">Go Back</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <div class="errors">
    <?php echo validation_errors(); ?>
    </div>
    <?php $attributes = array('id' => 'edit_animal'); ?>
    <?php echo form_open_multipart('editanimal' .'/'.$animal[0]['chart_num'], $attributes); ?>
    <?php if(empty($animal)){
      echo 'There was a problem retrieving your animal.';
    }?>
    
<?php if(isset($animal[0]['user']) && $animal[0]['user'] != "" && $animal[0]['user'] != NULL){ ?>
  <p>Last modified by <?=$animal[0]['user']?> on <?=$animal[0]['user_date']?> </p>
<?php } ?>

<div class="form-group">
     <a class="btn btn-info" href="<?php echo site_url('displayanimal/getcontract').'/'.$animal[0]['chart_num']; ?>" target="_blank">Adoption Contract PDF</a>

     <a class="btn btn-info" href="<?php echo site_url('displayanimal/getcompleteinfo').'/'.$animal[0]['chart_num']; ?>" target="_blank">Animal Information PDF</a>

     <a class="btn btn-info" href="<?php echo site_url('displayanimal/getmedicalinfo').'/'.$animal[0]['chart_num']; ?>" target="_blank">Animal Medical Info PDF</a>

     <a class="btn btn-info" href="<?php echo site_url('displayanimal/getnotes').'/'.$animal[0]['chart_num']; ?>" target="_blank">Animal Notes PDF</a>

      <a class="btn btn-info" href="<?php echo site_url('displaydocuments').'/'.$animal[0]['chart_num']; ?>">View/Add Extra Documents</a>

</div>

  <ul class="nav nav-pills" role="tablist">
      <li role="presentation" class="active"><a href="#general"  aria-controls="general" role="tab" data-toggle="tab">Basic Info</a></li>
      <li role="presentation"><a href="#rescue" aria-controls="rescue" role="tab" data-toggle="tab">Rescue Info</a></li>
      <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes, Behavior, &amp; SAFER Info</a></li>
  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="general">

<div class="form-group">
     <label for="name">Name:</label>
     <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
</div>

<div class="form-group">
     <label for="chart_num">Chart Number:</label>
     <input readonly autocomplete="off" type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
</div>


        <div class="form-group">
                <label for="status">Adopter:</label>
                <select name="adopter" id="adopter" class="form-control">
          <option selected="selected" value="">Select an Adopter</option>
          <option value="">N/A</option>
                  <?php
                    foreach($adopters as $adopter) { 
                     ?>
                      <option  value="<?= $adopter['id'] ?>"  <?php if($animal[0]['adopter'] == $adopter['id']) { ?> selected <?php } ?> ><?= $adopter['name'] ?></option>
                  <?php
                      
                    } ?>
                </select>
        </div>
<!--
        <?php
        if(!empty($adopter_history)){ ?>
          <h4>Previous Adopter(s):</h4>
          <ul>
          <?php
            foreach($adopter_history as $adopter){
          ?>
            <li><a href="<?php echo site_url('displayadopter').'/'.$adopter['adopter_id'] ?>"><?php echo $adopter['name'] . ' - ' . $adopter['status'] . ' - ' . $adopter['date_assigned'];?></a></li>
            <?php
              }
            ?>
        </ul>
        <?php } ?>
-->

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

      </div>
      <div role="tabpanel" class="tab-pane" id="rescue">

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
     <label for="age">Date of Birth or Age:</label>
     <input value="<?=$animal[0]['age']?>"type="text" size="20" id="age" name="age" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
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

        </div>
        <div role="tabpanel" class="tab-pane" id="notes">

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
     <img class="animalImage" src="<?=$animal[0]['picture']?>"/>
     <a href="removepicture/<?=$animal[0]['chart_num']?>">Remove Picture</a><br/>
<?php } ?>

<div class="form-group">
     <label for="medical_notes">Vet Notes:</label>
     <textarea rows="5" size="100" id="notes" name="medical_notes"  class="form-control"><?=$animal[0]['medical_notes']?></textarea>
</div>

        </div>
      </div>

  <ul class="nav nav-tabs" role="tablist">

      <li role="presentation"><a href="#weights" aria-controls="weights" role="tab" data-toggle="tab">Weights</a></li>

      <li role="presentation"><a href="#tests" aria-controls="tests" role="tab" data-toggle="tab">Preventative Tests</a></li>

      <li role="presentation"><a href="#medications" aria-controls="medications" role="tab" data-toggle="tab">Medications</a></li>


      <li role="presentation"><a href="#vaccinations" aria-controls="vaccinations" role="tab" data-toggle="tab">Vaccinations</a></li>

  </ul>

   <div class="tab-content">

    <div role="tabpanel" class="tab-pane" id="weights">
  <p>Weight Records</p>
  <div class="buttons" style="float:right;">
<a  class="btn btn-outline-success btn-sm" href="<?php echo site_url('addweight').'/'.$animal[0]['chart_num']; ?>">Add Weight Check-In</a>
<?php
if(!empty($weights)){ 
?>
<a  class="btn btn-outline-danger btn-sm" href="<?php echo site_url('removeweight').'/'.$animal[0]['chart_num']; ?>">Remove a Weight Check-In</a>
<?php }?>
</div>
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
</div>

<div role="tabpanel" class="tab-pane" id="tests">
  <p>Preventative Tests</p>
  <div class="buttons" style="float:right;">
<a  class="btn btn-outline-success btn-sm" href="<?php echo site_url('addtest').'/'.$animal[0]['chart_num']; ?>">Add Preventative Test</a>

<?php
if(!empty($tests)){
?>
<a  class="btn btn-outline-danger btn-sm" href="<?php echo site_url('removetest').'/'.$animal[0]['chart_num']; ?>">Remove a Preventative Test</a>
<?php }?>
</div>
<?php
if(!empty($tests)){
?>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date Tested</th>
        <th>Results</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($tests as $test) { ?>
  <tr>
    <td><?=$test['name']?></td>
    <td><?php $timestamp = strtotime($test['date_tested']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><?php if($test['results']){echo "POSITIVE";}else{ echo "NEGATIVE";} ?></td>
    <td><a href="<?php echo site_url('edittest').'/'.$animal[0]['chart_num'] .'/'.$test['id']?>">Edit</a></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>

<?php
} ?>
<a href="<?php echo site_url('displaytesthistory').'/'.$animal[0]['chart_num']; ?>">View Preventative Test History</a><br/>
</div>

<div role="tabpanel" class="tab-pane" id="medications">
  <p>Medications</p>
  <div class="buttons" style="float:right;">
<a  class="btn btn-outline-success btn-sm" href="<?php echo site_url('addmedication').'/'.$animal[0]['chart_num']; ?>">Add Medication</a>

<?php
if(!empty($medications)){
?>
<a  class="btn btn-outline-danger btn-sm" href="<?php echo site_url('removemedication').'/'.$animal[0]['chart_num']; ?>">Remove a Medication</a>
<?php }?>
</div>
<?php
if(!empty($medications)){
?>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date Started</th>
        <th>Date Completed</th>
        <th>Dose</th>
        <th>Duration</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach($medications as $medication) { ?>
  <tr>
    <td><?=$medication['name']?></td>
    <td><?php $timestamp = strtotime($medication['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?></td>
    <td><?php if($medication['date_due'] != null){ $timestamp = strtotime($medication['date_due']);$dmy = date("m/d/Y", $timestamp);echo $dmy; }?></td>
    <td><?=$medication['dose']?></td>
    <td><?=$medication['duration']?></td>
    <td><a href="<?php echo site_url('editmedication').'/'.$animal[0]['chart_num'] .'/'.$medication['id']?>">Edit</a></td>
  </tr>
  <tr>
      <td colspan="6">Notes:<?=$medication['notes']?></td>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>
  <a href="<?php echo site_url('displaymedicationhistory').'/'.$animal[0]['chart_num']; ?>">View Medication History</a><br/>

</div>

<div role="tabpanel" class="tab-pane" id="vaccinations">
<p>Vaccinations</p>
<div class="buttons" style="float:right;">
<a class="btn btn-outline-success btn-sm" href="<?php echo site_url('addvaccination').'/'.$animal[0]['chart_num']; ?>">Add Vaccination</a>
<?php
if(!empty($vaccinations)){
?>
<a class="btn btn-outline-danger btn-sm"href="<?php echo site_url('removevaccination').'/'.$animal[0]['chart_num']; ?>">Remove a Vaccination</a>
<?php }?>
</div>
<?php
if(!empty($vaccinations)){
?>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date Due</th>
        <th>Date Given</th>
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
    <tr>
      <?php if($vaccination['notes'] != null && $vaccination['notes'] != ""){?>
        <td colspan="4">Notes:<?=$vaccination['notes']?></td>
      <?php } ?>
  </tr>
  <?php }
  ?>
  </tbody>
  </table>
<?php
} ?>
  <a href="<?php echo site_url('displayvaccinationhistory').'/'.$animal[0]['chart_num']; ?>">View Vaccination History</a><br/>
</div>

</div>

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
<br/>
<br/>
<input class="btn btn-success" type="submit" style="float:right;" value="Edit Animal"/>

<?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>
    <input type="button" class="btn btn-danger confirm" style="float:left;" value="Delete Animal"/>
<?php } ?> 

   </form>
 </div>