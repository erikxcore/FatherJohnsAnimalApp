<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class AddAnimal extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('history','',TRUE);
   $this->load->model('run','',TRUE);

 }
 
 function index()
 {

    $this->load->library('form_validation');

    $data['allspecies'] = $this->animal->getAllSpecies();
    $data['acquired_method'] = $this->animal->getAllAcquiredMethod();
    $data['statuses'] = $this->animal->getAllStatus();
    $data['genders'] = $this->animal->getAllGenders();
    $data['runs'] = $this->animal->getAllRuns();

   if($this->session->userdata('logged_in'))
   {

     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }else{
         redirect('login', 'refresh');
   }

   if($this->session->userdata('superuser') != 1){
        $this->session->set_flashdata('results', 'You do not have the correct permission to add an animal.');
        redirect('/displayanimal/'.$chart_num, 'refresh');
   } 
     
     $this->form_validation->set_rules('name', 'Name', 'trim|required');
     $this->form_validation->set_rules('chart_num', 'Chart Number', 'trim|required');
     $this->form_validation->set_rules('run_num', 'Run Number', 'trim');
     $this->form_validation->set_rules('species', 'Species', 'trim');
     $this->form_validation->set_rules('date_of_arrival', 'Date of Arrival', 'trim|required');
     $this->form_validation->set_rules('acquired', 'Acquired', 'trim|required');
     $this->form_validation->set_rules('acquired_how', 'Acquired Method', 'trim');
     $this->form_validation->set_rules('microchip_num', 'Microchip Number', 'trim|required');
     $this->form_validation->set_rules('age', 'Age', 'trim');
     $this->form_validation->set_rules('sex', 'Gender', 'trim|required');
     $this->form_validation->set_rules('feeding_instructions', 'Feeding Instructions', 'trim');
     $this->form_validation->set_rules('status', 'Status', 'trim|required');
     $this->form_validation->set_rules('status_date', 'Status Date', 'trim|required');
     $this->form_validation->set_rules('behavior_strategy', 'Behavior Strategy', 'trim');
     $this->form_validation->set_rules('safer_complete', 'SAFER Complete', 'trim');
     $this->form_validation->set_rules('notes', 'Notes', 'trim');

    $config = array(
    'upload_path' => "uploads/",
    'upload_url' => base_url() . "uploads/",
    'allowed_types' => "gif|jpg|png|jpeg|pdf"
    );

    $this->load->library('upload', $config);
    
    if ($this->upload->do_upload('picture')) {
      $image_data = $this->upload->data();
      $picture = base_url() . "/uploads/" . $image_data['file_name'];
    }else{
      $picture = null;
    }

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Animal';
     $this->load->template('addanimal_view', $data);
   }
   else
   {

    $taken = false;
    
    $takenruns = $this->run->getTakenRuns();
    foreach($takenruns as $taken_run){
      if($this->input->post('run_num') == $taken_run['run_num']){
       $this->session->set_flashdata('results', 'That run is already occupied! Please remove the assigned animal first before assigning a new animal.');
     $taken = true;
     $data['title'] = 'Add an Animal';
     $this->load->template('addanimal_view', $data);
    }
    }

    $takencharts = $this->animal->getUsedChartNumbers();
    foreach($takencharts as $taken_chart){
      if($this->input->post('chart_num') == $taken_chart['chart_num']){
       $this->session->set_flashdata('results', 'That chart number is already used! Please use a different one.');
       $taken = true;
       $data['title'] = 'Add an Animal';
       $this->load->template('addanimal_view', $data);
      }
    }

    if(!$taken){
     $this->add_animal($this->input->post('name'),$this->input->post('chart_num'),$this->input->post('run_num'),$this->input->post('species'),$this->input->post('breed'),$this->input->post('date_of_arrival'),$this->input->post('acquired'),$this->input->post('acquired_how'),$this->input->post('microchip_num'),$this->input->post('age'),$this->input->post('sex'),$this->input->post('feeding_instructions'),$this->input->post('status'),$this->input->post('status_date'),$this->input->post('behavior_strategy'),$this->input->post('notes'),$this->input->post('safer_complete'),$picture);
     $this->session->set_flashdata('results', 'Animal succesfully added!'); 
     redirect('/home', 'refresh');
    }
   }
 
 }
 

 function add_animal($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$picture){
    $date_of_arrival = date('Y-m-d', strtotime($date_of_arrival));
    $status_date = date('Y-m-d', strtotime($status_date));
    
    $date = date('Y-m-d');
    $sd = $this->session->userdata('logged_in');
    $user= $sd['username'];


    $result = $this->animal->add($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$picture,$user,$date);

    if($result){
      $this->history->addHistoryEntry($user,$date,"Added a new animal : " . $name);
      return TRUE;
    }else{
           $this->session->set_flashdata('results', 'There was a problem adding a new animal.');
      return false;
    }
 }

}
?>