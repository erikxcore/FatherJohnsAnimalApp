<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditSpeciesName extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('species','',TRUE);
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


    $data['species'] = $this->species->getSpeciesNameById($id);

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a species.');
        redirect('/displayspecies', 'refresh');
   }

   $this->form_validation->set_rules('id', 'ID', 'trim|required');
   $this->form_validation->set_rules('name', 'Name', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit A Species';
     $this->load->template('editspeciesname_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_species_name($this->input->post('id'),$this->input->post('name'));
     $this->session->set_flashdata('results', 'Species succesfully modified!');
     redirect('/displayspecies', 'refresh');
   }else{
     $data['title'] = 'Edit A Species';
     $this->load->template('editspeciesname_view', $data);
   }
 
 }

 function edit_species_name($id,$name){

    $result = $this->species->editSpeciesName($id,$name);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem editing the species.');
      return false;
    }
 }

 

 
}
 
?>