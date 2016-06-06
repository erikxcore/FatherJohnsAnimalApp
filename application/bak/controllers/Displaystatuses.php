<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayStatuses extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('status','',TRUE);
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
    $data['allstatuses'] = $this->status->getStatusName();

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Statuses';
     $this->load->template('displaystatuses_view', $data);

 }
 
  function removestatusname($id){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a status.');
        redirect('/displaystatuses', 'refresh');
    }

    $this->status->removeStatusName($id[0]);

    $this->session->set_flashdata('results', 'Status successfully removed from the database.');
    
    redirect('/displaystatuses', 'refresh');

 }

 
}
 
?>