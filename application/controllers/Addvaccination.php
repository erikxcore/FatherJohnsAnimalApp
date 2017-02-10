<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddVaccination extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('vaccination','',TRUE);
   $this->load->model('vaccination_history','',TRUE);

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
    $data['vaccinations'] = $this->vaccination->getVaccinationName();

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

   $i = 0;
   //poor implementation
   foreach($data['vaccinations'] as $vaccination) { 
     $this->form_validation->set_rules('vac_name_'.$i, 'Vaccination Name', 'trim');
     $this->form_validation->set_rules('vac_check_'.$i, 'Vaccination Check', 'trim');
     $this->form_validation->set_rules('serial_num_'.$i, 'Serial Number', 'trim');
     $this->form_validation->set_rules('date_given_'.$i, 'Date Given', 'trim');
     $this->form_validation->set_rules('date_completed_'.$i, 'Date Completed', 'trim');
     $i++;
   }

   $processed = false;
   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Animal\'s Vaccination';
     $this->load->template('addvaccination_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $i = 0;
     $vac_to_add = array();
     foreach($data['vaccinations'] as $vaccination) { 
     if($this->input->post('vac_check_'.$i) == "enabled"){
      $vac = array();
      array_push($vac,$this->input->post('date_given_'.$i),$this->input->post('date_completed_'.$i),$this->input->post('vac_name_'.$i),$this->input->post('serial_num_'.$i));
      array_push($vac_to_add,$vac);
      $processed = true;
     }
      $i++;
     }

     if(!$processed){
     $data['title'] = 'Add an Animal\'s Vaccination';
     $this->session->set_flashdata('results', 'Please enable at least one vaccination!');
     $this->load->template('addvaccination_view', $data);
     }else{

     $this->add_vaccination($this->input->post('chart_num'),$vac_to_add);
     $this->session->set_flashdata('results', 'Vaccination succesfully added!');

     redirect('/editanimal/'.$chart_num, 'refresh');
     }
   }else{
     $data['title'] = 'Add an Animal\'s Vaccination';
     $this->load->template('addvaccination_view', $data);
    }

 }

 function add_vaccination($chart_num,$vac_to_add){
    $session_data = $this->session->userdata('logged_in');

    $result = true;
    $entry = null;

    foreach($vac_to_add as $vaccination) { 
         $date_converted1 = date('Y-m-d', strtotime($vaccination['0']));
          if($vaccination['1'] == null){
          $date_converted2 = null;
        }else{
          $date_converted2 = date('Y-m-d', strtotime($vaccination['1']));
        }
        try{
        $this->vaccination->addVaccination($chart_num,$date_converted1,$date_converted2,$vaccination['2'],$vaccination['3']);

        $entry = $entry . "Vaccination " . $vaccination['2'] . " / Serial Number: " . $vaccination['3'] . " for " . $chart_num . ' has been added on ' . date('Y-m-d') . '. Date given is now ' . $date_converted1 . '. Date completed is now ' . $date_converted2 . '<br/>' . " by " . $session_data['username'] . "<br/>";


        }catch(Exception $e){
          $result = false;
          goto return_results;
        }
      //3 = serial number, 2 = name  0 = date given, 1 = date completed
    }



    if($result){

            $this->vaccination_history->addVaccinationHistory($chart_num,$entry);

      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the animal\'s vaccination.');
      return false;
    }

      return_results:
      $this->session->set_flashdata('results', 'There was a problem adding the animal\'s vaccination.');
      return false;

 }

 

 
}
 
?>
