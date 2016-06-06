<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayMedicationHistory extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('medication','',TRUE);
   $this->load->model('medication_history','',TRUE);

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

    $data['allmedications'] = $this->medication_history->getAllHistory($chart_num);

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Medications for ' . $chart_num;
     $this->load->template('displaymedicationhistory_view', $data);

 }


 
}
 
?>