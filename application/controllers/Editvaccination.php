<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditVaccination extends CI_Controller {
 
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
 

 function index($chart_num,$id)
 {
    if($chart_num == null){
      show_404();
    }

    if($id == null){
      show_404();
    }

    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['vaccination'] = $this->vaccination->getVaccinationById($id[0]);

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
   $this->form_validation->set_rules('vac_name', 'Vaccination Name', 'trim|required');
   //$this->form_validation->set_rules('serial_num', 'Serial Number', 'trim');
   $this->form_validation->set_rules('date_given', 'Date Given', 'trim|required');
   $this->form_validation->set_rules('date_completed', 'Date Completed', 'trim');
   $this->form_validation->set_rules('vac_notes', 'Vaccination Notes', 'trim');
   $this->form_validation->set_rules('vac_source', 'Vaccination Source', 'trim');
   $this->form_validation->set_rules('vac_series', 'Vaccination Series', 'trim');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit An Animal\'s Vaccination';
     $this->load->template('editvaccination_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_vaccination($this->input->post('id'),$this->input->post('vac_name'),$this->input->post('date_given'),$this->input->post('date_completed'),$this->input->post('chart_num'),$this->input->post('vac_notes'),$this->input->post('vac_source'),$this->input->post('vac_series'));
     $this->session->set_flashdata('results', 'Vaccination succesfully modified!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Edit An Animal\'s Vaccination';
     $this->load->template('editvaccination_view', $data);
   }
 

 }

 function edit_vaccination($id,$name,$date_given,$date_completed,$chart_num,$notes,$source,$series){
    $session_data = $this->session->userdata('logged_in');


    $date_converted1 = date('Y-m-d', strtotime($date_given));
    if($date_completed == null){
    $date_converted2 = null;
    }else{
    $date_converted2 = date('Y-m-d', strtotime($date_completed));
    }

    $result = $this->vaccination->editVaccination($id,$date_converted1,$date_converted2,$name,$notes,$source,$series);

    $entry = "Vaccination " . " for " . $chart_num . ' has been updated on ' . date('Y-m-d') . '. Date given is now ' . $date_converted1 . '. Date completed is now ' . $date_converted2 . "<br/> by " . $session_data['username'] . "</br>";


    if($result){
      $this->vaccination_history->addVaccinationHistory($chart_num,$entry);
          if($date_completed != null && $date_completed != ""){
        if($series != null && $series != ""){
            $series_json = json_decode($series,true);
            if($series_json != null){
              //var_dump($series_json);

              foreach($series_json as $json){
                //var_dump($json);
              $iterator = $json[0]['iterator'];
              $amount = $json[0]['amount'];

              if($iterator == "days"){
                $day = $amount * 1;
                $date_converted2 = date('Y-m-d', strtotime($date_completed . ' + ' . $day . ' days'));
              }else if($iterator == "weeks"){
                $day = $amount * 7;
                $date_converted2 = date('Y-m-d', strtotime($date_completed . ' + ' . $day . ' days'));
              }else if($iterator == "months"){
                $day = $amount * 30;
                $date_converted2 = date('Y-m-d', strtotime($date_completed . ' + ' . $day . ' days'));
              }else if($iterator == "years"){
                $day = $amount * 365;
                $date_converted2 = date('Y-m-d', strtotime($date_completed . ' + ' . $day . ' days'));
              }
              //var_dump($date_converted2);
                $this->vaccination->addVaccination($chart_num,$date_converted2,null,$name,$notes,$source,$series);
              }
            }
        }
    }
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem editing the animal\'s vaccination.');
      return false;
    }
 }

 

 
}
 
?>