    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Preventative Test History</h1>
    </div>
      <div class="well">

            <a href="javascript:history.back()">Go Back</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <tbody>
          <?php
            foreach($alltests as $test) { ?>
            <tr>
              <td>
            <?=$test['chart_num']?>
              </td>
            <td>
            <?=$test['entry']?>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>


      </div>



   </div>