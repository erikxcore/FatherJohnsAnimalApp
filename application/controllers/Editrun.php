<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditRun extends CI_Controller {
 
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
    $data['totalrun'] = $this->run->getTotalRuns();


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
   $this->form_validation->set_rules('name', 'Name', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit A Run';
     $this->load->template('editrun_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_run($this->input->post('id'),$this->input->post('name'),$this->input->post('order_num'));
     redirect('/displayruns', 'refresh');
   }else{
     $data['title'] = 'Edit A Run';
     $this->load->template('editrun_view', $data);
   }
 
 }

 function edit_run($id,$name,$order){

    $result = $this->run->editRun($id,$name,$order);

    if($result){
      $this->session->set_flashdata('results', 'Run succesfully modified!');
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem modifying the run. Perhaps the order number is already taken.');
      return false;
    }
 }

 

 

 
}
 
?>