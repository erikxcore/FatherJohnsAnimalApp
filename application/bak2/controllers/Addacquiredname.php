<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddAcquiredName extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('acquired','',TRUE);
 } 

 function index()
 {

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a method.');
        redirect('/displayacquiredmethods', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Method';
     $this->load->template('addacquiredname_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_method_name($this->input->post('name'));
     $this->session->set_flashdata('results', 'Method succesfully added!');
        redirect('/displayacquiredmethods', 'refresh');
   }else{
     $data['title'] = 'Add a Method';
     $this->load->template('addacquiredname_view', $data);
    }

 }

 function add_method_name($name){

    $result = $this->acquired->addAcquiredName($name);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the method.');
      return false;
    }
 }

 

 
}
 
?>