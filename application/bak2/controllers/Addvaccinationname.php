<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddVaccinationName extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('vaccination','',TRUE);
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a vaccination.');
        redirect('/displayvaccinations', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Vaccination';
     $this->load->template('addvaccinationname_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_vaccination_name($this->input->post('name'));
     $this->session->set_flashdata('results', 'Vaccination succesfully added!');
     redirect('/displayvaccinations', 'refresh');
   }else{
     $data['title'] = 'Add a Vaccination';
     $this->load->template('addvaccinationname_view', $data);
    }

 }

 function add_vaccination_name($name){

    $result = $this->vaccination->addVaccinationName($name);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the vaccination.');
      return false;
    }
 }

 

 
}
 
?>