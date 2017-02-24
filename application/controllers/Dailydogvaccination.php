<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DailyDogVaccination extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
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

    $data['allvaccinations'] = $this->vaccination->getAllDogVaccinationByDate($date);
    $data['overduevaccinations'] = $this->animal->getOverdueVaccinationRequiredDogs();

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

     $data['title'] = 'Display All Dog Vaccinations due on ' . $date;
     $this->load->template('dailyvaccinations_view', $data);

 }
 

 
}
 
?>