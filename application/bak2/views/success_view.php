    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h1>Results</h1>
    </div>

    <?php if(!empty($this->session->flashdata('results'))){ ?>
        <?php echo $this->session->flashdata('results'); ?>
    <?php } ?>

 </div>