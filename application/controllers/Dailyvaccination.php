<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DailyVaccination extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('vaccination','',TRUE);
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


 function index()
 {

 	$date = $this->input->get('date'); 

    $data['allvaccinations'] = $this->vaccination->getAllVaccinationByDate($date);

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }	
   	 $data['date'] = $date;

     $data['title'] = 'Display All Vaccinations due on ' . $date;
     $this->load->template('dailyvaccinations_view', $data);

 }
 

 
}
 
?>