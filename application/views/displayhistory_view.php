    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>History</h1>
    </div>
      <div class="well">

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Date</th>
              <th>Event</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($allhistory as $history) { ?>
            <tr>
                <td>
                  <?=$history->user?>
              </td>
            <td>
                  <?=$history->date?>
              </td>
              <td>
                  <?=$history->notes?>
              </td>
            </tr>
          <?php
            } ?>
            </tbody>
        </table>
   <p><?php echo $links; ?></p>

      </div>



   </div>