<script type="text/javascript">
$(function() {
    $('.confirm').click(function(e) {
        //e.preventDefault();
        if(!window.confirm("Are you sure you want to delete this adopter?")){
          return false;
        }else{
          location.href="<?=site_url();?>displayadopters/removeadopter/<?=$adopter[0]['id']?>";
        };
    });
});
</script>

    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Adopter's Record</h1>
    </div>

    <a href="<?=site_url();?>displayadopters">Go Back to Display Adopter Page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editadopter' .'/'.$adopter[0]['id'] );?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$adopter[0]['id']?>"/>
      </div>


      <div class="form-group">
           <label for="name">Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$adopter[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Contact Number:</label>
           <input type="text" size="20" id="phone" name="phone" class="form-control" value="<?=$adopter[0]['phone']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Address:</label>
           <input type="text" size="20" id="address" name="address" class="form-control" value="<?=$adopter[0]['address']?>"/>
      </div>

      <div class="form-group">
           <label for="name">City/State/Zip:</label>
           <input type="text" size="20" id="city" name="city" class="form-control" value="<?=$adopter[0]['city']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Email Address:</label>
           <input type="text" size="20" id="email" name="email" class="form-control" value="<?=$adopter[0]['email']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Driver License Number:</label>
           <input type="text" size="20" id="license" name="license" class="form-control" value="<?=$adopter[0]['license']?>"/>
      </div>
      
      <?php if(isset($adopter[0]['chart_num'])) { ?>
        <p>Assigned Animals:</p>
      <?php
      $chart_num_array = unserialize($adopter[0]['chart_num']);
      if(is_array($chart_num_array)){
        foreach($chart_num_array as $chart_num) {
        ?>
      <a href="<?php echo site_url('displayanimal').'/'.$chart_num ?>">View Details <?=$chart_num?></a></br>
      <?php } }
      } ?>

<input class="btn btn-success" type="submit" style="float:right;" value="Edit Adopter"/>

<?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>
    <input type="button" class="btn btn-danger confirm" style="float:left;" value="Delete Adopter"/>
<?php } ?> 

   </form>

 </div>