
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Animal Weight Record</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editweight' .'/'.$animal[0]['chart_num'] .'/'.$weight[0]['id']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$weight[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="weight">Weight:</label>
           <input type="text" size="20" id="weight" name="weight" class="form-control" value="<?=$weight[0]['weight']?>"/>
      </div>

        <div class="form-group">
             <label for="date">Date Taken:</label>
             <input value="<?php $timestamp = strtotime($weight[0]['date']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="date" name="date" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

     <input class="btn btn-success" type="submit" value="Edit Weight"/>
   </form>

 </div>