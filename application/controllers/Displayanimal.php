<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayAnimal extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('vaccination','',TRUE);
   $this->load->model('medication','',TRUE);
   $this->load->model('weight','',TRUE);
   $this->load->model('safer','',TRUE);
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

    $this->load->library('form_validation');

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


   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display An Animal';
     $this->load->template('displayanimal_view', $data);
    
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