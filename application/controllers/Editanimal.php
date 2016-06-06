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
    $data['weights'] = $this->weight->getAllWeights($chart_num);
    $data['safer_results'] = $this->safer->getSaferResults($chart_num);
    $data['allspecies'] = $this->animal->getAllSpecies();
    $data['acquired_method'] = $this->animal->getAllAcquiredMethod();
    $data['statuses'] = $this->animal->getAllStatus();
    $data['genders'] = $this->animal->getAllGenders();
    $data['runs'] = $this->animal->getAllRuns();


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
   $this->form_validation->set_rules('medical_notes', 'Medical Notes', 'trim');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit An Animal';
     $this->load->template('editanimal_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
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

     $this->edit_animal($this->input->post('name'),$this->input->post('chart_num'),$this->input->post('run_num'),$this->input->post('species'),$this->input->post('breed'),$this->input->post('date_of_arrival'),$this->input->post('acquired'),$this->input->post('acquired_how'),$this->input->post('microchip_num'),$this->input->post('age'),$this->input->post('sex'),$this->input->post('feeding_instructions'),$this->input->post('status'),$this->input->post('status_date'),$this->input->post('behavior_strategy'),$this->input->post('notes'),$this->input->post('safer_complete'),$this->input->post('medical_notes'),$picture);
     $this->session->set_flashdata('results', 'Animal succesfully modified!');

     redirect('/editanimal/'.$chart_num, 'refresh');

   }else{
    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['title'] = 'Edit An Animal';
    $this->load->template('editanimal_view', $data);   }

 }

  function edit_animal($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$medical_notes,$picture){
    $date_of_arrival = date('Y-m-d', strtotime($date_of_arrival));
    $status_date = date('Y-m-d', strtotime($status_date));

      $date = date('Y-m-d H:i:s');
      $sd = $this->session->userdata('logged_in');
      $user= $sd['username'];

    $result = $this->animal->edit($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$picture,$user,$date,$medical_notes);

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

  function getcontract($chart_num)
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

     $this->load->library('pdf');

     $pdf =  $this->pdf->load();

       //$pdf->allow_output_buffering = true;
       //$pdf->debug = true;

     $pdf->SetImportUse();
     

      $pagecount = $pdf->SetSourceFile("uploads/NewForm3.pdf");

      for ($i=1; $i<=($pagecount); $i++) {
          $pdf->AddPage();
          $import_page = $pdf->ImportPage($i);
          $pdf->UseTemplate($import_page);
      }

$pdfFilePath = "uploads/NewForm".date('m-d-Y-His').".pdf";
 
if (file_exists($pdfFilePath) == FALSE)
{
    ini_set('memory_limit','32M');

    $pdf->WriteText(100,200,"Nothing now!");
    
    $pdf->Output($pdfFilePath, 'F');
}
 
redirect($pdfFilePath);



 }


function getinfo($chart_num){

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

      

     $this->load->library('pdf');

     $pdf =  $this->pdf->load();

    //$pdf->allow_output_buffering = true;
    //$pdf->debug = true;

     $pdf->SetImportUse();

      $pagecount = $pdf->SetSourceFile("uploads/NewForm3.pdf");

      for ($i=1; $i<=($pagecount); $i++) {
          $pdf->AddPage();
          $import_page = $pdf->ImportPage($i);
          $pdf->UseTemplate($import_page);
      }

$pdfFilePath = "uploads/InfoFormFor".$chart_num[0].".pdf";


$animal = $this->animal->getAnimalById($chart_num[0]);

    $pdf->WriteText(10,10,"Database ID : " . $animal[0]['id'] );
    $pdf->WriteText(10,20,"Name : " . $animal[0]['name'] );    
    $pdf->WriteText(10,30,"Chart Number : " . $animal[0]['chart_num'] );    
    $pdf->WriteText(10,40,"Run Number : " . $animal[0]['run_num'] );    
    $pdf->WriteText(10,50,"Species : " . $animal[0]['species'] );    
    $pdf->WriteText(10,60,"Breed : " . $animal[0]['breed'] );    
    $pdf->WriteText(10,70,"Date of Arrival : " . $animal[0]['date_of_arrival'] );    
    $pdf->WriteText(10,80,"Acquired Method: " . $animal[0]['acquired'] );    
    $pdf->WriteText(10,90,"Acquired How : " . $animal[0]['acquired_how'] );    
    $pdf->WriteText(10,100,"Microchip Number : " . $animal[0]['microchip_num'] );    
    $pdf->WriteText(10,110,"Age : " . $animal[0]['age'] );    
    $pdf->WriteText(10,120,"Gender : " . $animal[0]['sex'] );    
    $pdf->WriteText(10,130,"Feeding Instructions : " . $animal[0]['feeding_instructions'] );    
    $pdf->WriteText(10,140,"Current Status : " . $animal[0]['status'] );    
    $pdf->WriteText(10,150,"Date of Status Change : " . $animal[0]['status_date'] );    
    $pdf->WriteText(10,160,"SAFER Complete : " . $animal[0]['safer_complete'] );    
    $pdf->WriteText(10,170,"Behavior Strategy : " . $animal[0]['behavior_strategy'] );    
    $pdf->WriteText(10,180,"Notes : " . $animal[0]['notes'] );    
    $pdf->WriteText(10,200,"Medical Notes : " . $animal[0]['medical_notes'] );    

    $pdf->Output($pdfFilePath, 'F');

redirect($pdfFilePath);

}
 
}
 
?>