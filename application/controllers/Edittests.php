<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditTests extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('test','',TRUE);
   $this->load->model('animal','',TRUE);
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

    $data['allspecies'] = $this->animal->getAllSpecies();

    if($id == null){
      show_404();
    }


    $data['test'] = $this->test->getTestById($id);

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a vaccination.');
        redirect('/displayvaccinations', 'refresh');
   }

   $this->form_validation->set_rules('id', 'ID', 'trim|required');
   $this->form_validation->set_rules('name', 'Name', 'trim|required');
   $this->form_validation->set_rules('species', 'Species', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit A Test';
     $this->load->template('edittests_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_test($this->input->post('id'),$this->input->post('name'),$this->input->post('species'));
     $this->session->set_flashdata('results', 'Test succesfully modified!');
     redirect('/displaytests', 'refresh');
   }else{
     $data['title'] = 'Edit A Test';
     $this->load->template('edittests_view', $data);
   }
 
 }

 function edit_test($id,$name,$species){

    $result = $this->test->editTest($id,$name,$species);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem editing the test.');
      return false;
    }
 }

 

 
}
 
?>