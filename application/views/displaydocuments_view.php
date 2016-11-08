   <script type="text/javascript">
$(document).on('change', ':file', function() {
    var input = $(this);
    $('.pendingFiles').html('');
    var names = [];
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
        names.push($(this).get(0).files[i].name);
    }
    input.trigger('fileselect', [names]);
});
$(document).ready( function() {
    $(':file').on('fileselect', function(event, names) {
      for(var i = 0; i < names.length; i++){
        $('.pendingFiles').append('<p>'+names[i]+'</p>')
      }
    });
});

   </script>
   
    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Documents</h1>
    </div>
      <div class="well">

            <a href="<?php echo site_url('displayanimal').'/'.$chart_num ?>">Go Back</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <tbody>
          <?php
            foreach($documents as $document) { ?>
            <tr>
              <td>
             <a href="<?=$document['url']?>" target="_blank"><?=$document['url']?></a>
              </td>
              <td>
                <a href="remove_document/<?=$chart_num?>/<?=$document['id']?>">Remove</a>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

    </div>
    <h4>Upload Files</h4>
    <?php echo form_open_multipart('displaydocuments'.'/'.$chart_num);?>

           
<?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>
           
<div class="form-group">
           <label class="btn btn-default btn-file">
              Browse <input type="file" multiple="" name="documents[]" style="display: none;">
          </label>
          <div class="pendingFiles"></div>
</div>  

    <input class="btn btn-success" type="submit" name="submit" style="float:right;" value="Upload"/>

    </form>

<?php } ?>



   </div>