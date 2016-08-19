    
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
        <select name="search_type" id="search_type">
          <option selected="selected" value="">Choose a search type</option>
              <option value="id" <?php echo set_select('search_type', 'id'); ?>>By Chart Number</option>
              <option value="name" <?php echo set_select('search_type', 'name'); ?>>By Name</option>
              <option value="run" <?php echo set_select('search_type', 'run'); ?>>By Run Name</option>
              <option value="status" <?php echo set_select('search_type', 'status'); ?>>By Status</option>
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
  }

});
    });
   </script>