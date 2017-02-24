    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>View An Adopter</h1>
    </div>

   
    <a href="<?=site_url();?>displayadopters">Go Back to Display Adopters Page</a></br>


    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo form_open('displayadopter' .'/'.$adopter[0]['id']); ?>

     <?php if($document_count > 0) { ?>
     <a class="btn btn-info" href="<?php echo site_url('displayadopterdocuments').'/'.$adopter[0]['id']; ?>">View Extra Documents</a>
     <?php } ?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$adopter[0]['id']?>"/>
      </div>


      <div class="form-group">
           <label for="name">Name:</label>
           <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$adopter[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Contact Number:</label>
           <input readonly type="text" size="20" id="phone" name="phone" class="form-control" value="<?=$adopter[0]['phone']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Address:</label>
           <input readonly type="text" size="20" id="address" name="address" class="form-control" value="<?=$adopter[0]['address']?>"/>
      </div>

      <div class="form-group">
           <label for="name">City/State/Zip:</label>
           <input readonly type="text" size="20" id="city" name="city" class="form-control" value="<?=$adopter[0]['city']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Email Address:</label>
           <input readonly type="text" size="20" id="email" name="email" class="form-control" value="<?=$adopter[0]['email']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Driver License Number:</label>
           <input readonly type="text" size="20" id="license" name="license" class="form-control" value="<?=$adopter[0]['license']?>"/>
      </div>

      <div class="checkbox">
          <label>
            <input <?php if($adopter[0]['is_blacklisted'] == 1) { ?> checked <?php } ?> value="true" type="checkbox" name="blacklisted" id="blacklisted"> Blacklisted?
          </label>
      </div>

      <div class="form-group">
           <label for="notes">Notes:</label>
           <textarea rows="5" size="100" id="notes" name="notes"  class="form-control"><?=$adopter[0]['notes']?></textarea>
      </div>

      <?php if(!empty($adopter[0]['chart_num'])){ ?>
        <p>Assigned Animals:</p>
      <?php
      $chart_num_array = unserialize($adopter[0]['chart_num']);
      if(is_array($chart_num_array)){
        foreach($chart_num_array as $chart_num) {
        ?>
      <a href="<?php echo site_url('displayanimal').'/'.$chart_num ?>">View Details <?=$chart_num?></a></br>
      <?php } }
      } ?>

   </form>

<?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>

</br>
<input type="button" value="Edit This Adopter" style="float:right;" class="btn btn-success" onclick="location.href='<?php echo site_url('editadopter').'/'.$adopter[0]['id'] ?>'">

<?php } ?>

   
 </div>