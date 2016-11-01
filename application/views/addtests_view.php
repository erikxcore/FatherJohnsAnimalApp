    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Add A Preventative Test</h1>
    </div>
    
    <a href="<?=site_url();?>displaytests">Go Back to Display All Tests page</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('addtests');?>

      <div class="form-group">
           <label for="name">Test Name:</label>
           <input type="text" size="20" id="name" name="name" class="form-control" value=""/>
      </div>

      <div class="form-group">
           <label for="species">Species:</label>
              <select name="species" id="species" class="form-control">
                <option selected="selected" value="">Choose a species</option>
                <!--<option value="ALL">All</option>-->
                <?php
                  foreach($allspecies as $specie) { ?>
                    <option value="<?= $specie['name'] ?>" <?php echo set_select('species', $specie['name']); ?> > <?= $specie['name']?></option>
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
                      <option value="<?=$i?>"><?=$i?></option>
                    <?php
                    $i++;
                     }
                     ?>
                  </select> 
                </div>


     <input class="btn btn-success" type="submit" value="Add Test"/>
   </form>

 </div>