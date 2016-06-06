
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit An Animal Vaccination Record</h1>
    </div>

    <a href="<?=site_url();?>editanimal/<?=$animal[0]['chart_num']?>">Go Back to Edit page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('editvaccination' .'/'.$animal[0]['chart_num'] .'/'.$vaccination[0]['id']);?>

      <div class="form-group">
           <label for="chart_num">Chart Number:</label>
           <input readonly type="text" size="20" id="chart_num" name="chart_num" class="form-control" value="<?=$animal[0]['chart_num']?>"/>
      </div>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$vaccination[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="vac_name">Vaccination Name:</label>
           <input type="text" size="20" id="vac_name" name="vac_name" class="form-control" value="<?=$vaccination[0]['name']?>"/>
      </div>

        <div class="form-group">
             <label for="date">Date Given:</label>
             <input value="<?php $timestamp = strtotime($vaccination[0]['date_given']);$dmy = date("m/d/Y", $timestamp);echo $dmy;?>" type="text" size="20" id="date_given" name="date_given" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

        <div class="form-group">
             <label for="date">Date Due:</label>
             <input value="<?php if($vaccination[0]['date_completed'] != null){ $timestamp = strtotime($vaccination[0]['date_completed']);$dmy = date("m/d/Y", $timestamp);echo $dmy; }?>" type="text" size="20" id="date_completed" name="date_completed" class="datepicker form-control" data-date-format="mm/dd/yyyy"/>
        </div>

     <input class="btn btn-success" type="submit" value="Edit Vaccination"/>
   </form>

 </div>