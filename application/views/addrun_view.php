   <!--
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
  -->


    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add A Run</h1>
    </div>
    
    <a href="<?=site_url();?>displayruns">Go Back to Display All Runs page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addrun');?>

      <div class="form-group">
           <label for="name">Run Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value=""/>
      </div>

      <div class="form-group">
        <label for="status">Order Number:</label>
        <select name="order_num" id="order_num" class="form-control">
          <option selected="selected" value="">Please select a value...</option>
          <option value="">None</option>
          <?php
          $i = 1;
          $totalrun = $totalrun + 1; //because we're adding this could potentially be a new number
          while($i <= $totalrun){
          ?>
            <option value="<?=$i?>"><?=$i?></option>
          <?php
          $i++;
           }
           ?>
        </select> 
</div>


<!--
      <div class="form-group">
           <label for="name">Color:</label>
           <input type="color" size="20" id="color" name="color" class="form-control color startEmpty" value=""/>
      </div>
-->
     <input class="btn btn-success" type="submit" value="Add Run"/>
   </form>

 </div>