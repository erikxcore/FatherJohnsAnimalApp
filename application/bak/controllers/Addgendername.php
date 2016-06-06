<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddGenderName extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('gender','',TRUE);
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a gender.');
        redirect('/displaygenders', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Gender';
     $this->load->template('addgendername_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_gender_name($this->input->post('name'));
     $this->session->set_flashdata('results', 'Gender succesfully added!');
     redirect('/displaygenders', 'refresh');
   }else{
     $data['title'] = 'Add a Gender';
     $this->load->template('addgendername_view', $data);
    }

 }

 function add_gender_name($name){

    $result = $this->gender->addGenderName($name);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the gender.');
      return false;
    }
 }

 

 
}
 
?>