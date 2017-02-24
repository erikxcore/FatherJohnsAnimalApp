<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditMedication extends CI_Controller {
 
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
 

 function index($chart_num,$id)
 {

    if($chart_num == null){
      show_404();
    }

    if($id == null){
      show_404();
    }


    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['medication'] = $this->medication->getMedicationById($id[0]);

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
   $this->form_validation->set_rules('chart_num', 'Chart Number', 'trim|required');
   $this->form_validation->set_rules('med_name', 'Medication Name', 'trim|required');
   $this->form_validation->set_rules('date_given', 'Date Given', 'trim|required');
   $this->form_validation->set_rules('date_due', 'Date Completed', 'trim');
   $this->form_validation->set_rules('med_notes', 'Medication Notes', 'trim');
   $this->form_validation->set_rules('med_duration', 'Duration', 'trim');
   $this->form_validation->set_rules('med_dose', 'Dose', 'trim');
   $this->form_validation->set_rules('given', 'Given', 'trim');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit An Animal\'s Medication';
     $this->load->template('editmedication_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_medication($this->input->post('id'),$this->input->post('med_name'),$this->input->post('date_given'),$this->input->post('date_due'),$this->input->post('med_notes'),$this->input->post('chart_num'),$this->input->post('med_duration'),$this->input->post('med_dose'),$this->input->post('given'));
     $this->session->set_flashdata('results', 'Medication succesfully modified!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Edit An Animal\'s Medication';
     $this->load->template('editmedication_view', $data);
   }
 
 }

 function edit_medication($id,$name,$date_given,$date_due,$notes,$chart_num,$duration,$dose,$given){
    if($given == "true"){
      $given = true;
    }else{
      $given = false;
    }


    $session_data = $this->session->userdata('logged_in');

    $date_converted1 = date('Y-m-d', strtotime($date_given));
    
    if($date_due == null ){
      $date_converted2 = null;
    }else{
      $date_converted2 = date('Y-m-d', strtotime($date_due));
    }

    $result = $this->medication->editMedication($id,$date_converted1,$date_converted2,$name,$notes,$duration,$dose,$given);

    $entry = "Medication " . $name . " for " . $chart_num . ' has been updated on ' . date('Y-m-d') . '. Date given is now ' . $date_converted1 . '. Date due is now ' . $date_converted2 . '<br/> Dose is now ' . $dose . '<br/> Duration is now ' . $duration . "<br/> by " . $session_data['username'];


    if($result){
        $this->medication_history->addMedicationHistory($chart_num,$entry);
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem editing the animal\'s medication.');
      return false;
    }
 }

 

 
}
 
?>