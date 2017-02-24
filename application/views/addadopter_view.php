    <div class="container theme-showcase" role="main">

    <div class="page-header">
      <h1>Add An Adopter</h1>
    </div>
    
    <a href="<?=site_url();?>displayadopters">Go Back to Display Adopter Page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addadopter');?>


      <div class="form-group">
           <label for="name">Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?php echo set_value('name'); ?>"/>
      </div>

      <div class="form-group">
           <label for="name">Contact Number:</label>
           <input type="text" size="20" id="phone" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>"/>
      </div>

      <div class="form-group">
           <label for="name">Address:</label>
           <input type="text" size="20" id="address" name="address" class="form-control" value="<?php echo set_value('address'); ?>"/>
      </div>

      <div class="form-group">
           <label for="name">City/State/Zip:</label>
           <input type="text" size="20" id="city" name="city" class="form-control" value="<?php echo set_value('city'); ?>"/>
      </div>

      <div class="form-group">
           <label for="name">Email Address:</label>
           <input type="text" size="20" id="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>"/>
      </div>

      <div class="form-group">
           <label for="name">Driver License Number:</label>
           <input type="text" size="20" id="license" name="license" class="form-control" value="<?php echo set_value('license'); ?>"/>
      </div>

      <div class="checkbox">
          <label>
            <input value="true" type="checkbox" name="blacklisted" id="blacklisted"> Blacklisted?
          </label>
      </div>

      <div class="form-group">
           <label for="notes">Notes:</label>
           <textarea rows="5" size="100" id="notes" name="notes"  class="form-control"></textarea>
      </div>

     <input class="btn btn-success" type="submit" value="Add Adopter"/>
   </form>

 </div>