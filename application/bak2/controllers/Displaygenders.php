<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayGenders extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('gender','',TRUE);
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
    $data['allgenders'] = $this->gender->getGenderName();

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Genders';
     $this->load->template('displaygenders_view', $data);

 }
 
  function removegendername($id){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a gender.');
        redirect('/displaygenders', 'refresh');
    }

    $this->gender->removeGenderName($id[0]);

    $this->session->set_flashdata('results', 'Gender successfully removed from the database.');
    
    redirect('/displaygenders', 'refresh');

 }

 
}
 
?>