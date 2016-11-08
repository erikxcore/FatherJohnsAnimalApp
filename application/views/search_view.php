    
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Search</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    
    <?php echo validation_errors(); ?>
    <?php echo form_open('search');?>


      <div class="form-group">
           <label for="search_value">Search For:</label>
           <input autocomplete="off" type="text" size="20" id="search_value" name="search_value" class="form-control" value="<?=set_value('search_value')?>"/>
      </div>

      <div class="form-group">
        <span> by </span>
        <select name="search_type" id="search_type" style="color:black;">
          <option selected="selected" value="" style="color:black;">Choose a search type</option>
              <option style="color:black;" value="id" <?php echo set_select('search_type', 'id'); ?>>By Chart Number</option>
              <option style="color:black;" value="name" <?php echo set_select('search_type', 'name'); ?>>By Name</option>
              <option style="color:black;" value="run" <?php echo set_select('search_type', 'run'); ?>>By Run Name</option>
              <option style="color:black;" value="status" <?php echo set_select('search_type', 'status'); ?>>By Status</option>
              <option style="color:black;" value="adopter_name" <?php echo set_select('search_type', 'adopter_name'); ?>>By Adoptee's Name</option>
              <option style="color:black;" value="adopter_phone" <?php echo set_select('search_type', 'adopter_phone'); ?>>By Adoptee's Phone</option>
              <option style="color:black;" value="adopter_email" <?php echo set_select('search_type', 'adopter_email'); ?>>By Adoptee's Email</option>
        </select> 
      </div>

     <input class="btn btn-success" type="submit" value="Search"/>

   </div>

    <script type="text/javascript">
    $( document ).ready(function() {
       names = [];
       charts = [];
       runs = [];
       statuses = [];
       adoptees_names = [];
       adoptees_emails = [];
       adoptees_phones = [];

              <?php
                    foreach($animalnames as $animal) { ?>
                    names.push("<?=$animal['name']?>");
              <?php } ?>
              <?php
                    foreach($animalcharts as $chart) { ?>
                    charts.push("<?=$chart['chart_num']?>");
              <?php } ?>
              <?php
                    foreach($animalruns as $run) { ?>
                    runs.push("<?=$run['name']?>");
              <?php } ?>
              <?php
                    foreach($animalstatuses as $status) { ?>
                    statuses.push("<?=$status['name']?>");
              <?php } ?>
              <?php
                    foreach($adopters as $adopter) { ?>
                    adoptees_names.push("<?=$adopter['name']?>");
                    <?php if(isset($adopter['email'])){ ?>
                    adoptees_emails.push("<?=$adopter['email']?>");
                    <?php } ?>
                     <?php if(isset($adopter['phone'])){ ?>
                    adoptees_phones.push("<?=$adopter['phone']?>");
                       <?php } ?>
              <?php } ?>

$('#search_type').change(function() {
  val = $(this).val();

  if(val == "name"){
            $( "#search_value" ).autocomplete({
              source: names
            });
  }else if(val == "id"){
            $( "#search_value" ).autocomplete({
              source: charts
            });
  }else if(val == "run"){
            $( "#search_value" ).autocomplete({
              source: runs
            });
  }else if(val == "status"){
            $( "#search_value" ).autocomplete({
              source: statuses
            });
  }else if(val == "adopter_name"){
            $( "#search_value" ).autocomplete({
              source: adoptees_names
            });
  }else if(val == "adopter_phone"){
            $( "#search_value" ).autocomplete({
              source: adoptees_phones
            });
  }else if(val == "adopter_email"){
            $( "#search_value" ).autocomplete({
              source: adoptees_emails
            });
  }

});
    });
   </script>