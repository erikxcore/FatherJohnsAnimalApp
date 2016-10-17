<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddMedication extends CI_Controller {
 
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
     
   $this->form_validation->set_rules('chart_num', 'Chart Number', 'trim|required');
   $this->form_validation->set_rules('med_name', 'Medication Name', 'trim|required');
   $this->form_validation->set_rules('date_given', 'Date Given', 'trim|required');
   $this->form_validation->set_rules('date_due', 'Date Due', 'trim|required');
   $this->form_validation->set_rules('med_notes', 'Medication Notes', 'trim');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Animal\'s Medication';
     $this->load->template('addmedication_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_medication($this->input->post('chart_num'),$this->input->post('med_name'),$this->input->post('date_given'),$this->input->post('date_due'),$this->input->post('med_notes'));
     $this->session->set_flashdata('results', 'Medication succesfully added!');
      redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Add an Animal\'s Medication';
     $this->load->template('addmedication_view', $data);
   }
 }



 function add_medication($chart_num,$name,$date_given,$date_due,$notes){
      $session_data = $this->session->userdata('logged_in');

    $date_converted1 = date('Y-m-d', strtotime($date_given));
    $date_converted2 = date('Y-m-d', strtotime($date_due));
    $result = $this->medication->addMedication($chart_num,$date_converted1,$date_converted2,$name,$notes);
    
        $entry = "Medication " . $name . " for " . $chart_num . ' has been added on ' . date('Y-m-d') . '. Date given is now ' . $date_converted1 . '. Date due is now ' . $date_converted2 . '<br/>'. ' by ' . $session_data['username'];

    if($result){
                  $this->medication_history->addMedicationHistory($chart_num,$entry);
      return TRUE;
    }else{
           $this->session->set_flashdata('results', 'There was a problem adding the animal\'s medication.');
      return false;
    }
 }

 

 
}
 
?>