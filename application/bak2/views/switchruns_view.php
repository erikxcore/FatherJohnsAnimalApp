    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Switch Runs</h1>
    </div>

    <a href="<?=site_url();?>displayruns">Go Back to Display All Runs page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('switchruns');?>

<div class="form-group">
        <label for="id1">Run 1:</label>
        <select name="id1" id="id1" class="form-control">
          <?php
            foreach($runs as $run) { ?>
              <option  value="<?= $run['id'] ?>"><?= $run['name'] ?> Order Number: <?=$run['order_num']?></option>
          <?php
            } ?>
        </select> 
</div>

<div class="form-group">
        <label for="id2">Run 2:</label>
        <select name="id2" id="id2" class="form-control">
          <?php
            foreach($runs as $run) { ?>
              <option  value="<?= $run['id'] ?>"><?= $run['name'] ?> Order Number: <?=$run['order_num']?></option>
          <?php
            } ?>
        </select> 
</div>

     <input class="btn btn-success" type="submit" value="Switch Runs"/>
   </form>

 </div>