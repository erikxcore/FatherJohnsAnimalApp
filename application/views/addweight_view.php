    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add Animal Weight Record</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addweight' .'/'.$animal[0]['chart_num']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Name:</label>
           <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="weight">Weight:</label>
           <input type="text" size="20" id="weight" name="weight" class="form-control" value="<?php echo set_value('weight'); ?>"/>
      </div>

        <div class="form-group">
             <label for="date">Date Taken:</label>
             <input value="<?php echo set_value('date'); ?>" type="text" size="20" id="date" name="date" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

     <input class="btn btn-success" type="submit" value="Add Weight"/>
   </form>

 </div>