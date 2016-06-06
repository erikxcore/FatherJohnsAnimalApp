
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit A Species</h1>
    </div>

    <a href="<?=site_url();?>displayspecies">Go Back to Display All Species page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editspeciesname'.'/'.$species[0]['id']);?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$species[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Species Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$species[0]['name']?>"/>
      </div>


     <input class="btn btn-success" type="submit" value="Edit Species"/>
   </form>

 </div>