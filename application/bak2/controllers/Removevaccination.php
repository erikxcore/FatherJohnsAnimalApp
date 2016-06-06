<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RemoveVaccination extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('vaccination','',TRUE);
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
 

 function index($chart_num)
 {

    if($chart_num == null){
      show_404();
    }

    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['vaccinations'] = $this->vaccination->getAllVaccination($chart_num);

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify an animal.');
        redirect('/displayanimal/'.$chart_num, 'refresh');
     }

   $this->form_validation->set_rules('id', 'ID', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Remove an Animal\'s Vaccination';
     $this->load->template('removevaccination_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->remove_vaccination($this->input->post('id'));
     $this->session->set_flashdata('results', 'Vaccination succesfully removed!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Remove an Animal\'s Vaccination';
     $this->load->template('removevaccination_view', $data);
   }
 

 }

 function remove_vaccination($id){
    $result = $this->vaccination->removeVaccination($id);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem removing the animal\'s vaccination.');
      return false;
    }
 }

 

 
}
 
?>