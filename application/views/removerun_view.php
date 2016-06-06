
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
         <h1>Home</h1>
         <h2>Welcome <?php echo $username; ?>!</h2>
    </div>

    <div class="page-header">
        <h1>Remove Run</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open('removerun'); ?>

      <div class="form-group">
        <select name="run" id="run">
          <option class="form-control" selected="selected" value="">Choose a run</option>
          <?php
            foreach($runs as $run) { ?>
              <option value="<?= $run['id'] ?>"><?= $run['name'] ?></option>
          <?php
            } ?>
        </select>
      </div>

     <input class="btn btn-success" type="submit" value="Remove Run"/>
   </form>

 </div>