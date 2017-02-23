
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit A Vaccination Type</h1>
    </div>

    <a href="<?=site_url();?>displayvaccinations">Go Back to Display All Vaccinations page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editvaccinationname'.'/'.$vaccination[0]['id']);?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$vaccination[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Vaccination Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$vaccination[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="brand_name">Brand Name:</label>
           <input type="text" size="20" id="brand_name" name="brand_name" class="form-control" value="<?=$vaccination[0]['brand_name']?>"/>
      </div>

      <div class="form-group">
           <label for="serial_number">Serial Number:</label>
           <input type="text" size="20" id="serial_number" name="serial_number" class="form-control" value="<?=$vaccination[0]['serial_number']?>"/>
      </div>

      <div class="form-group">
           <label for="expiration_date">Expiration Date:</label>
           <input value="<?php $timestamp = strtotime($vaccination[0]['expiration_date']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="expiration_date" name="expiration_date" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
      </div>

      <div class="form-group">
              <label for="type">Type:</label>
              <select name="type" id="type" class="form-control">
                <option value="">N/A</option>
                <option <?php if(strtolower($vaccination[0]['type']) == strtolower("injection")){?> selected="selected" <?php } ?> value="Injection">Injection</option>
                <option <?php if(strtolower($vaccination[0]['type']) == strtolower("nasal")){?> selected="selected" <?php } ?> value="Nasal">Nasal</option>
              </select> 
      </div>


     <input class="btn btn-success" type="submit" value="Edit Vaccination"/>
   </form>

 </div>