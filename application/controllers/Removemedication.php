<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RemoveMedication extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('medication','',TRUE);
   $this->load->model('medication_history','',TRUE);
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
    $data['medications'] = $this->medication->getAllMedication($chart_num);

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
     $data['title'] = 'Remove an Animal\'s Medication';
     $this->load->template('removemedication_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->remove_medication($this->input->post('id'),$chart_num);
     $this->session->set_flashdata('results', 'Medication successfully removed!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Remove an Animal\'s Medication';
     $this->load->template('removemedication_view', $data);
   }

 }

 function remove_medication($id,$chart_num){
    $name = $this->medication->getMedicationById($id)[0]['name'];
    $result = $this->medication->removeMedication($id);

    if($result){
          $entry = "Medication " . $name . " for " . $chart_num . ' has been updated on ' . date('Y-m-d') . '. Medication entry has been removed.';
          $this->medication_history->addMedicationHistory($chart_num,$entry);
      return TRUE;
    }else{
                $this->session->set_flashdata('results', 'There was a problem removing the animal\'s medication.');
      return false;
    }
 }

 

 
}
 
?>