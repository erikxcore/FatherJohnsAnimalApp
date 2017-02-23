    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add A Vaccination Type</h1>
    </div>
    
    <a href="<?=site_url();?>displayvaccinations">Go Back to Display All Vaccinations page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addvaccinationname');?>

      <div class="form-group">
           <label for="name">Vaccination Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value=""/>
      </div>

      <div class="form-group">
           <label for="brand_name">Brand Name:</label>
           <input type="text" size="20" id="brand_name" name="brand_name" class="form-control" value=""/>
      </div>

      <div class="form-group">
           <label for="serial_number">Serial Number:</label>
           <input type="text" size="20" id="serial_number" name="serial_number" class="form-control" value=""/>
      </div>

      <div class="form-group">
           <label for="expiration_date">Expiration Date:</label>
           <input value="" type="text" size="20" id="expiration_date" name="expiration_date" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
      </div>

      <div class="form-group">
              <label for="type">Type:</label>
              <select name="type" id="type" class="form-control">
                <option selected="selected" value="">N/A</option>
                <option value="Injection">Injection</option>
                <option value="Nasal">Nasal</option>
              </select> 
      </div>

     <input class="btn btn-success" type="submit" value="Add Vaccination"/>
   </form>

 </div>