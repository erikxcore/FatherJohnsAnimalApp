<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddStatusName extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('status','',TRUE);
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a status.');
        redirect('/displaystatuses', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Status';
     $this->load->template('addstatusname_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_status_name($this->input->post('name'),$this->input->post('color'));
     $this->session->set_flashdata('results', 'Status succesfully added!');
     redirect('/displaystatuses', 'refresh');
   }else{
     $data['title'] = 'Add a Status';
     $this->load->template('addstatusname_view', $data);
    }

 }

 function add_status_name($name,$color){

    $result = $this->status->addStatusName($name,$color);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the status.');
      return false;
    }
 }

 

 
}
 
?>