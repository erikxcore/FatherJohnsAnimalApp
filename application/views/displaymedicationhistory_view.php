    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Medication History</h1>
    </div>
      <div class="well">

            <a href="javascript:history.back()">Go Back</a></br>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <tbody>
          <?php
            foreach($allmedications as $medication) { ?>
            <tr>
              <td>
            <?=$medication['chart_num']?>
              </td>
            <td>
            <?=$medication['entry']?>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>

   <div class="paged_links"><?php echo $links; ?></div>

      </div>



   </div>