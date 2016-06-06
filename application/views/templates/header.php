<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Father John's Adoption Private Manager">
    <meta name="author" content="Eric Barber">
    <link rel="icon" href="<?php echo asset_url("favicon.ico");?>">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo asset_url("css/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo asset_url("css/theme.css"); ?>" />
    <link rel="stylesheet" href="<?php echo asset_url("css/bootstrap-datepicker.css"); ?>" />
    <script type="text/javascript" src="<?php echo asset_url("js/jQuery-1.10.2.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo asset_url("js/jquery-ui.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo asset_url("js/bootstrap.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo asset_url("js/bootstrap-datepicker.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo asset_url("css/jquery-ui.css"); ?>" />
    <script type="text/javascript">
     $( document ).ready(function() { 
      //No use running this constantly. This check realistically shouldn't even be here - it should be on the pages that specifically use the datepicker.
      //If you want to modify this it is NOT jQuery UI datepicker - it is bootstrap datepicker. jQuery UI does not auto update (forceParse) input values on change. Also theming is ugly.
      if ($(".datepicker").length){
        if($('#age.datepicker').length){
          $('#age.datepicker').datepicker({"forceParse": false,"clearBtn": true,"autoclose":true,"startView":1,"minView":1});
        }
        $('.datepicker').datepicker({"clearBtn": true,"autoclose": true,"startView":1,"minView":1});
        }   
     });
    </script>
 </head>
<body role="document">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Father John's Animal Database</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
               <li><a href="<?php echo site_url('home') ?>">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Options<span class="caret"></span></a>
              <ul class="dropdown-menu">
               <?php if(isset($_SESSION['goduser']) && $_SESSION['goduser'] == 1 ){ ?>
               <li><a href="<?php echo site_url('adduser') ?>">Add a user</a></li>
               <li><a href="<?php echo site_url('removeuser') ?>">Remove a user</a></li>
               <li><a href="<?php echo site_url('promoteuser') ?>">Promote a user</a></li>
               <li><a href="<?php echo site_url('demoteuser') ?>">Demote a user</a></li>
               <li><a href="<?php echo site_url('changeallpassword') ?>">Change A User's Password</a></li>
               <li><a href="<?php echo site_url('homepageoptions') ?>">Modify Homepage</a></li>
               <li><a href="<?php echo site_url('displayhistory') ?>">View Event Log</a></li>
               <li><a href="<?php echo site_url('displayusers') ?>">View All Users</a></li>
               <?php } ?>
               <li><a href="<?php echo site_url('changeuserpassword') ?>">Change Your Password</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animal Options<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php if(isset($_SESSION['superuser']) && $_SESSION['superuser'] == 1 ){ ?>
               <li><a href="<?php echo site_url('addanimal') ?>">Add an animal</a></li>
               <li><a href="<?php echo site_url('displayvaccinations') ?>">Display/Adjust Vaccination Types</a></li>
               <li><a href="<?php echo site_url('displaygenders') ?>">Display/Adjust Gender Types</a></li>
               <li><a href="<?php echo site_url('displaystatuses') ?>">Display/Adjust Statuses</a></li>
               <li><a href="<?php echo site_url('displayacquiredmethods') ?>">Display/Adjust Acquired Methods</a></li>
               <li><a href="<?php echo site_url('displayspecies') ?>">Display/Adjust Species</a></li>
               <li><a href="<?php echo site_url('displayruns') ?>">Display/Adjust Runs</a></li>
                <?php } ?>
                 <li><a href="<?php echo site_url('displayanimals') ?>">View All Animals</a></li>
                 <!-- This hasn't been done yet - doesn't really seem to be a need with homepage view. Why would we need to specifically go into a run if we can go by other details?
                 Searching via run is possible, as well. -->
                 <!--<li><a href="<?php echo site_url('displayanimalsrun') ?>">View All Animals By Run</a></li>-->
                 <li><a href="<?php echo site_url('displayadopted') ?>">View All Adopted Animals</a></li>
                 <li><a href="<?php echo site_url('displaynonadopted') ?>">View All Non-Adopted Animals</a></li>
                 <li><a href="<?php echo site_url('displaydogs') ?>">View All Dogs</a></li>
                 <li><a href="<?php echo site_url('displaycats') ?>">View All Cats</a></li>
               <li><a href="<?php echo site_url('search') ?>">Search</a></li>
              </ul>
            </li>
            <li><a href="<?=site_url();?>home/logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>