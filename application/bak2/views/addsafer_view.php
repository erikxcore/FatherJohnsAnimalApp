    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add SAFER Results</h1>
    </div>
    
    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addsafer' .'/'.$animal[0]['chart_num']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="test_1">Test 1:</label>
           <input type="text" size="20" id="test_1" name="test_1" class="form-control" value="<?php echo set_value('test_1'); ?>"/>
      </div>

      <div class="form-group">
           <label for="test_2">Test 2:</label>
           <input type="text" size="20" id="test_2" name="test_2" class="form-control" value="<?php echo set_value('test_2'); ?>"/>
      </div>

      <div class="form-group">
           <label for="test_3">Test 3:</label>
           <input type="text" size="20" id="test_3" name="test_3" class="form-control" value="<?php echo set_value('test_3'); ?>"/>
      </div>

      <div class="form-group">
           <label for="test_4">Test 4:</label>
           <input type="text" size="20" id="test_4" name="test_4" class="form-control" value="<?php echo set_value('test_4'); ?>"/>
      </div>
      <div class="form-group">
           <label for="test_5">Test 5:</label>
           <input type="text" size="20" id="test_5" name="test_5" class="form-control" value="<?php echo set_value('test_5'); ?>"/>
      </div>

      <div class="form-group">
           <label for="test_6">Test 6:</label>
           <input type="text" size="20" id="test_6" name="test_6" class="form-control" value="<?php echo set_value('test_6'); ?>"/>
      </div>

      <div class="form-group">
           <label for="test_7">Test 7:</label>
           <input type="text" size="20" id="test_7" name="test_7" class="form-control" value="<?php echo set_value('test_7'); ?>"/>
      </div>

     <input class="btn btn-success" type="submit" value="Add SAFER Results"/>
   </form>

 </div>
