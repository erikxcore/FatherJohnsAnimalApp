

    <div class="container theme-showcase" role="main">

    <div class="page-header">
      <!--  <h1>Modify Homepage</h1>  -->
    </div>
    
    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php 
	$attributes = array('id' => 'homepage_form');
    echo form_open('homepageoptions',$attributes);?>

          <?php foreach($homePageOptions as $option) { ?>

        <input name="sections_json_old" id="sections_json_old" class="sections_json_old" type="hidden" value="<?=htmlspecialchars($option['sections_json'])?>">

        <div class="checkbox">
             <input type="checkbox" value="true" id="enabled" name="enabled" <?php if($option['enabled'] == true ){?> checked <?php } ?>>Enable Custom View?
        </div>

        <div class="form-group">
             <label for="sections">Total Amount of Sections:</label>
             <input value="<?= $option['sections'] ?>" type="number" size="20" min="0"  step="1" id="sections" name="sections" class="form-control"/>
        </div>

        <div class="rowsPerSection">

        </div>

        <input type="hidden" name="sections_json" id="sections_json" />

        <?php } ?>

     <input class="btn btn-success" type="submit" value="Update Homepage"/>
   </form>

 </div>
 
     <script type="text/javascript">
			$( document ).ready(function() {

				if($("#sections").val() >= 0){
					generateRowsSectionPreload();
				}else{
					$(".rowsPerSection").html("To select how many rows you would like to display per section please select a numeric amount for total sections above.");
				}

				if($(".sections_json_old").val()){
					loadJsonValues();
				}


				$('#sections').on('input', function() {
					generateRowsSection();
				});

				$('#homepage_form').on('submit', function(e) {
				        e.preventDefault();
				        generateJson();
				        if(window.confirm("Are you sure you wish to make this change?")){
				 			this.submit();
				 		}
				});
			});


			function generateRowsSection(){
				if($("#sections").val() <= 0){
					$(".rowsPerSection").html("Please select a whole number bigger than 0");
				}else{

					$(".rowsPerSection").html("");

					var totalRows = $("#sections").val();
					var count = 1;

					while(count <= totalRows){
					$(".rowsPerSection").append('<div class="form-group"><label for="section_'+count+'">Amount for section '+count+'</label><input value="" type="number" size="20" min="0"  step="1" id="section_'+count+'" name="section_'+count+'" class="form-control"/></div>');
					count++;
					}


				}
			}

			function generateRowsSectionPreload(){
				if($("#sections").val() > 0){

					$(".rowsPerSection").html("");

					var totalRows = $("#sections").val();
					var count = 1;

					while(count <= totalRows){
					$(".rowsPerSection").append('<div class="form-group"><label for="section_'+count+'">Amount for section '+count+'</label><input value="" type="number" size="20" min="0"  step="1" id="section_'+count+'" name="section_'+count+'" class="form-control"/></div>');
				    count++;
					}
			}
		}

			function generateJson(){
				var totalRows = $("#sections").val();
				var generated = null;
				var count = 1;
				generated = '{"sections" : [';
				
				while(count <= totalRows){
				var total_row = $("#section_"+count).val();
				if(count == totalRows){
				generated += '{"section_id":"'+count+'","section_total_rows":"'+total_row+'"}';
				}else{
				generated += '{"section_id":"'+count+'","section_total_rows":"'+total_row+'"},';
				}
				count++;
				}

				generated += '] }';

				$('#sections_json').val(generated);
			}

			function loadJsonValues(){
				var json = $(".sections_json_old").val();
				var jobj = $.parseJSON(json);

    			var count = 0;

			    $.each(jobj, function(idx, obj) {
			    	$.each(obj, function(){
					$("#section_"+obj[count].section_id).val(obj[count].section_total_rows);
				count++;
			    	});
				});
				
			}

    </script>