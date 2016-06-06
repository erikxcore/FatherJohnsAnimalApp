<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditAcquiredName extends CI_Controller {
 
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
 

 function index($id)
 {


    if($id == null){
      show_404();
    }


    $data['method'] = $this->acquired->getAcquiredNameById($id);

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a method.');
        redirect('/displayacquiredmethods', 'refresh');
   }

   $this->form_validation->set_rules('id', 'ID', 'trim|required');
   $this->form_validation->set_rules('name', 'Name', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit A Method';
     $this->load->template('editacquiredname_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_method_name($this->input->post('id'),$this->input->post('name'));
     $this->session->set_flashdata('results', 'Method succesfully modified!');
     redirect('/displayacquiredmethods', 'refresh');
   }else{
     $data['title'] = 'Edit A Method';
     $this->load->template('editacquiredname_view', $data);
   }
 
 }

 function edit_method_name($id,$name){

    $result = $this->acquired->editAcquiredName($id,$name);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem editing the method.');
      return false;
    }
 }

 

 
}
 
?>