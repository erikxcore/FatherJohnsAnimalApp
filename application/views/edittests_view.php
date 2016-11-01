
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Edit A Preventative Test</h1>
    </div>

    <a href="<?=site_url();?>displaytests">Go Back to Display All Tests page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('edittests'.'/'.$test[0]['id']);?>

      <div class="form-group">
           <label for="id">ID:</label>
           <input readonly type="text" size="20" id="id" name="id" class="form-control" value="<?=$test[0]['id']?>"/>
      </div>

      <div class="form-group">
           <label for="name">Test Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value="<?=$test[0]['name']?>"/>
      </div>

      <div class="form-group">
           <label for="species">Species:</label>
              <select name="species" id="species" class="form-control">
                <option value="">Choose a species</option>
                <option <?php if($test[0]['species'] == "ALL"){?>selected="selected"<?php } ?> value="ALL">All</option>
                <?php
                  foreach($allspecies as $specie) { ?>
                    <option <?php if($test[0]['species'] == $specie['name']){?>selected="selected"<?php }?> value="<?= $specie['name'] ?>"><?= $specie['name'] ?></option>
                <?php
                  } ?>
              </select> 
      </div>

                <div class="form-group">
                  <label for="group_num">Group ID:</label>
                  <select name="group_num" id="group_num" class="form-control">
                    <option selected="selected" value="">N/A</option>
                    <?php
                    $i = 1;
                    $totaltest = $totaltest + 1; //because we're adding this could potentially be a new number
                    while($i <= $totaltest){
                    ?>
                      <option value="<?=$i?>" <?php if($i == $test[0]['group_num']){ ?>selected<?php } ?>><?=$i?></option>
                    <?php
                    $i++;
                     }
                     ?>
                  </select> 
                </div>

     <input class="btn btn-success" type="submit" value="Edit Test"/>
   </form>

 </div>