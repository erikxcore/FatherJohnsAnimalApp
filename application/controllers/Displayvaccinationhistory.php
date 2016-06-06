<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayVaccinationHistory extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('vaccination','',TRUE);
   $this->load->model('vaccination_history','',TRUE);

 }
 
   function _remap($method,$args)
  {

  if (method_exists($this, $method))
  {
  $this->$method($args);
  }
  else
  {
  $this->index($method,$args);
  }

  }
 

 function index($chart_num)
 {

    if($chart_num == null){
      show_404();
    }

    $data['allvaccinations'] = $this->vaccination_history->getAllVaccination($chart_num);

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Vaccinations for ' . $chart_num;
     $this->load->template('displayvaccinationhistory_view', $data);

 }


 
}
 
?>