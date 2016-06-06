    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add A Gender Type</h1>
    </div>
    
    <a href="<?=site_url();?>displaygenders">Go Back to Display All Genders page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addgendername');?>

      <div class="form-group">
           <label for="name">Gender Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value=""/>
      </div>

     <input class="btn btn-success" type="submit" value="Add Gender"/>
   </form>

 </div>