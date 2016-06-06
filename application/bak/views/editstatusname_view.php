    <script type="text/javascript" src="<?php echo asset_url("js/spectrum.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo asset_url("css/spectrum.css"); ?>" />
    <script type="text/javascript">
        $( document ).ready(function() {
    
         $('.color').spectrum();

        $('.color').spectrum({
              preferredFormat: "hex",
              allowEmpty: true,
              showInput: true
    });

  });
    </script>

    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit A Status Type</h1>
    </div>

    <a href="<?=site_url();?>displaystatuses">Go Back to Display All Statuses page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editstatusname'.'/'.$status[0]['id']);?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$status[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Status Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$status[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Color:</label>
           <input type="color" size="20" id="color" name="color" class="form-control color" value="<?=$status[0]['color']?>"/>
      </div>

     <input class="btn btn-success" type="submit" value="Edit Status"/>
   </form>

 </div>