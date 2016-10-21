<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddTests extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('test','',TRUE);
   $this->load->model('animal','',TRUE);
 } 

 function index()
 {
    $data['allspecies'] = $this->animal->getAllSpecies();

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a vaccination.');
        redirect('/displayvaccinations', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');
   $this->form_validation->set_rules('species', 'Species', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Test';
     $this->load->template('addtests_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_test($this->input->post('name'),$this->input->post('species'));
     $this->session->set_flashdata('results', 'Test succesfully added!');
     redirect('/displaytests', 'refresh');
   }else{
     $data['title'] = 'Add a Vaccination';
     $this->load->template('addtests_view', $data);
    }

 }

 function add_test($name,$species){

    $result = $this->test->addTest($name,$species);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the test.');
      return false;
    }
 }

 

 
}
 
?>