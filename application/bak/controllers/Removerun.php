<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RemoveRun extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('run','',TRUE);
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
 

 function index($id)
 {
    if($id == null){
      show_404();
    }

    $data['run'] = $this->run->getRun($id);

    $this->load->library('form_validation');

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a run.');
        redirect('/displayruns', 'refresh');
   }

   $this->form_validation->set_rules('id', 'ID', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Remove a Run';
     $this->load->template('removerun_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->remove_run($this->input->post('id'));
     $this->session->set_flashdata('results', 'Run successfully removed!');
     redirect('/displayruns', 'refresh');
   }else{
     $data['title'] = 'Remove a Run';
     $this->load->template('removerun_view', $data);
   }

 }

 function remove_run($id){
    $result = $this->run->removeRun($id);

    if($result){
      return TRUE;
    }else{
                $this->session->set_flashdata('results', 'There was a problem removing the run.');
      return false;
    }
 }

 

 
}
 
?>