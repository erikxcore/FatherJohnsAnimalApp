
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Animal Preventative Test Entry</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('edittest' .'/'.$animal[0]['chart_num'] .'/'.$test[0]['id']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$test[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="test_name">Test Name:</label>
           <input readonly type="text" size="20" id="test_name" name="test_name" class="form-control" value="<?=$test[0]['name']?>"/>
      </div>

        <div class="form-group">
             <label for="date">Date Tested:</label>
             <input value="<?php $timestamp = strtotime($test[0]['date_tested']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="date_tested" name="date_tested" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <div class="form-group">
               <label for="result">Result:</label>
                <select id="result" name="result" class="form-control" required>
                  <option value="">Choose Test Result</option>
                  <option <?php if( $test[0]['results'] == true){ ?> selected="selected" <?php }?> value="TRUE">PASS</option>
                  <option <?php if( $test[0]['results'] == false){ ?> selected="selected" <?php }?>  value="FALSE">FAIL</option>
                </select> 
        </div>

     <input class="btn btn-success" type="submit" value="Edit Vaccination"/>
   </form>

 </div>