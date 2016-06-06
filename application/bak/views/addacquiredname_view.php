    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add An Acquire Method</h1>
    </div>
    
    <a href="<?=site_url();?>displayacquiredmethods">Go Back to Display All Methods page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addacquiredname');?>

      <div class="form-group">
           <label for="name">Method Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value=""/>
      </div>

     <input class="btn btn-success" type="submit" value="Add Method"/>
   </form>

 </div>