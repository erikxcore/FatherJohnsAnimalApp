<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplaySpecies extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('species','',TRUE);
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
    $data['allspecies'] = $this->species->getSpeciesName();

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Species';
     $this->load->template('displayspecies_view', $data);

 }
 
  function removespeciesname($id){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a species.');
        redirect('/displayspecies', 'refresh');
    }

    $this->species->removeSpeciesName($id[0]);

    $this->session->set_flashdata('results', 'Species successfully removed from the database.');
    
    redirect('/displayspecies', 'refresh');

 }

 
}
 
?>