<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayAcquiredMethods extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('acquired','',TRUE);
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
    $data['allmethods'] = $this->acquired->getAcquiredName();

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Methods';
     $this->load->template('displayacquiredmethods_view', $data);

 }
 
  function removeacquiredname($id){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a method.');
        redirect('/displayacquiredmethods', 'refresh');
    }

    $this->acquired->removeAcquiredName($id[0]);

    $this->session->set_flashdata('results', 'Method successfully removed from the database.');
    
        redirect('/displayacquiredmethods', 'refresh');

 }

 
}
 
?>