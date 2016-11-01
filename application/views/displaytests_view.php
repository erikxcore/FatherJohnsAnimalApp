    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Preventative Tests</h1>
    </div>
      <div class="well">

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Species Type</th>
              <th>Group ID</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($alltests as $test) { ?>
            <tr>
              <td>
            <?=$test['id']?>
              </td>
               <td>
            <?=$test['name']?>
              </td>
            <td>
            <?=$test['species']?>
              </td>
               <td>
            <?=$test['group_num']?>
              </td>
              <td>
                <a href="<?php echo site_url('edittests').'/'.$test['id'] ?>">Edit</a>
              </td>
              <td>
                <a href="displaytests/removetest/<?=$test['id']?>">Remove</a><br/>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

                <a href="<?php echo site_url('addtests') ?>">Add a Preventative Test</a>

      </div>



   </div>