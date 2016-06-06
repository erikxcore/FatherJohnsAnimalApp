    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Remove a Medication Record</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('removemedication' .'/'.$animal[0]['chart_num']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Name:</label>
           <input readonly type="text" size="20" id="name" name="name" class="form-control" value="<?=$animal[0]['name']?>"/>
      </div>

      <div class="form-group">
        <label for="id">Medication:</label>
        <select name="id" id="id" class="form-control">
          <option value="">Select a Medication record</option>
          <?php
            foreach($medications as $medication) { ?>
              <option  value="<?= $medication['id'] ?>"><?= $medication['date_given'] ?> - <?=$medication['name']?></option>
          <?php
            } ?>
        </select> 
     </div>

     <input class="btn btn-success" type="submit" value="Remove Medication"/>
   </form>

 </div>