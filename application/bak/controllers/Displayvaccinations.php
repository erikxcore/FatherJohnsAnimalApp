<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayVaccinations extends CI_Controller {
 
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
    $data['allvaccinations'] = $this->vaccination->getVaccinationName();

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Vaccinations';
     $this->load->template('displayvaccinations_view', $data);

 }
 
  function removevaccinationname($id){
    if($id[0] == null){
      show_404();
    }


     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

   if($this->session->userdata('superuser') != 1){
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a vaccination.');
        redirect('/displayvaccinations', 'refresh');
    }

    $this->vaccination->removeVaccinationName($id[0]);

    $this->session->set_flashdata('results', 'Vaccination successfully removed from the database.');
    
    redirect('/displayvaccinations', 'refresh');

 }

 
}
 
?>