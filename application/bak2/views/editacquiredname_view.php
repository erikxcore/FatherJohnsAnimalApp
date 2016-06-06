
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Acquired Method</h1>
    </div>

    <a href="<?=site_url();?>displayacquiredmethods">Go Back to Display All Methods page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editacquiredname'.'/'.$method[0]['id']);?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$method[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Method Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$method[0]['name']?>"/>
      </div>


     <input class="btn btn-success" type="submit" value="Edit Method"/>
   </form>

 </div>