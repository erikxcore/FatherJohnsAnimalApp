    <script type="text/javascript">
      $('#testTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show');
      })
    </script>
    <div class="container theme-showcase" role="main">

    <div class="page-header">
   
   <h1>Add A Preventative Test</h1>

    </div>
    
    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addtest' .'/'.$animal[0]['chart_num']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Name:</label>
           <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
      </div>

  <ul class="nav nav-tabs" role="tablist">
    <?php  foreach($tests as $test) {
        $name = str_replace(array('.', ' ', '/'), '_', $test['name']);

    ?>
      <li role="presentation"><a href="#<?php echo $name; ?>" aria-controls="<?php echo $name; ?>" role="tab" data-toggle="tab"><?php echo $test['name']; ?></a></li>
    <?php } ?>
  </ul>

  <p>Note - you can enable multiple tests at once by clicking on the given check box and selecting another test.</p>
  <div class="tab-content">
          <?php
             $i = 0;
            foreach($tests as $test) { 
        $name = str_replace(array('.', ' ', '/'), '_', $test['name']);


            ?>
               <div role="tabpanel" class="tab-pane" id="<?php echo $name; ?>">

                  <div class="form-group">
                       <label for="test_name_<?=$i?>">Test Name:</label>
                       <input readonly type="text" size="20" id="test_name_<?=$i?>" name="test_name_<?=$i?>" class="form-control" value="<?php echo $test['name']; ?>"/>
                  </div>

                  <div class="checkbox">
                      <label>
                        <input value="enabled" type="checkbox" name="test_check_<?=$i?>" id="test_check_<?=$i?>"> Given to Animal?
                      </label>
                  </div>

                  <div class="form-group">
                       <label for="date_given_<?=$i?>">Date Tested:</label>
                       <input value="<?php echo set_value('date_given_<?=$i?>'); ?>" type="text" size="20" id="date_given_<?=$i?>" name="date_given_<?=$i?>" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
                  </div>

                <div class="form-group">
                       <label for="result_<?=$i?>">Result:</label>
                        <select id="result_<?=$i?>" name="result_<?=$i?>" class="form-control">
                          <option value="">Choose Test Result</option>
                          <option value="TRUE">POSITIVE</option>
                          <option value="FALSE">NEGATIVE</option>
                        </select> 
                </div>


              </div>

        <?php $i++; } ?>
</div>
  
  <br/>
  <br/>
     <input class="btn btn-success" type="submit" value="Add Preventative Test"/>
   </form>

 </div>