<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditAnimal extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('vaccination','',TRUE);
   $this->load->model('medication','',TRUE);
   $this->load->model('weight','',TRUE);
   $this->load->model('safer','',TRUE);
   $this->load->model('history','',TRUE);
   $this->load->model('run','',TRUE);
   $this->load->model('test','',TRUE);
   $this->load->model('adopter','',TRUE);
   $this->load->model('document','',TRUE);
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
    $data['vaccinations'] = $this->vaccination->getAllVaccination($chart_num);
    $data['tests'] = $this->test->getAllTest($chart_num);
    $data['weights'] = $this->weight->getAllWeights($chart_num);
    $data['safer_results'] = $this->safer->getSaferResults($chart_num);
    $data['allspecies'] = $this->animal->getAllSpecies();
    $data['acquired_method'] = $this->animal->getAllAcquiredMethod();
    $data['statuses'] = $this->animal->getAllStatus();
    $data['genders'] = $this->animal->getAllGenders();
    $data['runs'] = $this->animal->getAllRuns();
    $data['adopters'] = $this->adopter->getAllAdopters();
    $data['document_count'] = $this->document->record_count_documents($chart_num);
    
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

   $this->form_validation->set_rules('name', 'Name', 'trim|required');
   $this->form_validation->set_rules('chart_num', 'Chart Number', 'trim|required');
   $this->form_validation->set_rules('adopter', 'Adopter', 'trim');
   $this->form_validation->set_rules('run_num', 'Run Number', 'trim');
   $this->form_validation->set_rules('species', 'Species', 'trim|required');
   $this->form_validation->set_rules('breed', 'Breed', 'trim');
   $this->form_validation->set_rules('date_of_arrival', 'Date Of Arrival', 'trim|required');
   $this->form_validation->set_rules('acquired', 'Acquired', 'trim|required');
   $this->form_validation->set_rules('acquired_how', 'Acquired How', 'trim');
   $this->form_validation->set_rules('microchip_num', 'Microchip Number', 'trim');
   $this->form_validation->set_rules('age', 'Age', 'trim');
   $this->form_validation->set_rules('sex', 'Sex', 'trim|required');
   $this->form_validation->set_rules('feeding_instructions', 'Feeding Instructions', 'trim');
   $this->form_validation->set_rules('status', 'Status', 'trim|required');
   $this->form_validation->set_rules('status_date', 'Status Date', 'trim|required');
   $this->form_validation->set_rules('behavior_strategy', 'Behavior Strategy', 'trim');
   $this->form_validation->set_rules('safer_complete', 'SAFER Complete', 'trim');
   $this->form_validation->set_rules('notes', 'Notes', 'trim');
   $this->form_validation->set_rules('medical_notes', 'Vet Notes', 'trim');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit An Animal';
     $this->load->template('editanimal_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
    /*
    if($this->input->post('run_num') != null && $this->input->post('run_num') != ""){

        $animalInRun = $this->animal->getAnimalByRunId($this->input->post('run_num'));
        if($animalInRun){
          if($animalInRun[0]['chart_num'] != $this->input->post('chart_num')){
          $takenruns = $this->run->getTakenRuns();
          foreach($takenruns as $taken_run){
            if($this->input->post('run_num') == $taken_run['run_num']){
             $this->session->set_flashdata('results', 'That run is already occupied! Please remove the assigned animal first before assigning a new animal.');
             redirect('/editanimal/'.$chart_num, 'refresh');
            }
          }
        }
      }
    }
    */

    $config = array(
    'upload_path' => "uploads/",
    'upload_url' => base_url() . "uploads/",
    'allowed_types' => "gif|jpg|png|jpeg|pdf"
    );


    $this->load->library('upload', $config);

        $fileName =  uniqid() . 'file_' . $_FILES['picture']['name'];
        $fileName =  urlencode($fileName);
        $config['file_name'] = $fileName;
        $this->upload->initialize($config);

    if ($this->upload->do_upload('picture')) {
      $image_data = $this->upload->data();
      $picture = base_url() . "files/" . $fileName;
    }else{
      $picture = null;
    }

     $this->edit_animal($this->input->post('name'),$this->input->post('chart_num'),$this->input->post('run_num'),$this->input->post('species'),$this->input->post('breed'),$this->input->post('date_of_arrival'),$this->input->post('acquired'),$this->input->post('acquired_how'),$this->input->post('microchip_num'),$this->input->post('age'),$this->input->post('sex'),$this->input->post('feeding_instructions'),$this->input->post('status'),$this->input->post('status_date'),$this->input->post('behavior_strategy'),$this->input->post('notes'),$this->input->post('safer_complete'),$this->input->post('medical_notes'),$picture,$this->input->post('adopter'));
     $this->session->set_flashdata('results', 'Animal succesfully modified!');

     redirect('/editanimal/'.$chart_num, 'refresh');

   }else{
    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['title'] = 'Edit An Animal';
    $this->load->template('editanimal_view', $data);   }

 }

  function edit_animal($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$medical_notes,$picture,$adopter){
    $date_of_arrival = date('Y-m-d', strtotime($date_of_arrival));
    $status_date = date('Y-m-d', strtotime($status_date));

      $date = date('Y-m-d H:i:s');
      $sd = $this->session->userdata('logged_in');
      $user= $sd['username'];

    $result = $this->animal->edit($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$picture,$user,$date,$medical_notes,$adopter);

    if($result){
      $this->history->addHistoryEntry($user,$date,"Modified an animal : " . $name . " with chart number " . $chart_num);
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem modifying the animal.');
      return false;
    }
 }

 function delete_animal($chart_num)
 {
    if($chart_num == null){
      show_404();
    }

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to delete an animal.');
        redirect('/editanimal/'.$chart_num, 'refresh');
   }


   $this->animal->remove($chart_num[0]);
      
      $date = date('Y-m-d H:i:s');
      $sd = $this->session->userdata('logged_in');
      $user= $sd['username'];
      $this->history->addHistoryEntry($user,$date,"Removed an animal with the ID of : " . $chart_num[0]);

   $this->session->set_flashdata('results', 'Animal ' . $chart_num[0] . ' successfully removed from the database.');
   redirect('/home','refresh');
 }
 
  function removepicture($chart_num)
 {

    if($chart_num == null){
      show_404();
    }


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

   $this->animal->remove_image($chart_num[0]);

     $date = date('Y-m-d H:i:s');
      $sd = $this->session->userdata('logged_in');
      $user= $sd['username'];
      $this->history->addHistoryEntry($user,$date,"Removed an animal photo with the ID of : " . $chart_num[0]);

   $this->load->library('form_validation');

   $this->session->set_flashdata('results', 'Image successfully removed from the database.');
    
   redirect('/editanimal/'.$chart_num[0], 'refresh');


 }

 


 
}
 
?>