<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddSpeciesName extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('species','',TRUE);
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a species.');
        redirect('/displayspecies', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Species';
     $this->load->template('addspeciesname_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_species_name($this->input->post('name'));
     $this->session->set_flashdata('results', 'Species succesfully added!');
     redirect('/displayspecies', 'refresh');
   }else{
     $data['title'] = 'Add a Species';
     $this->load->template('addspeciesname_view', $data);
    }

 }

 function add_species_name($name){

    $result = $this->species->addSpeciesName($name);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the species.');
      return false;
    }
 }

 

 
}
 
?>