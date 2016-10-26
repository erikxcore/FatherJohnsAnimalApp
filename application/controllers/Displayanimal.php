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
   $this->load->model('test','',TRUE);

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
    $data['tests'] = $this->test->getAllTest($chart_num);
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

 $animal = $this->animal->getAnimalById($chart_num[0]);

   $this->load->library('pdf');  
   $pdf =  $this->pdf->load();

    $pdf->allow_output_buffering = true;
    $pdf->debug = true;

    $pdf->SetImportUse();

    $pagecount = $pdf->SetSourceFile("uploads/AdoptionContractTemplate.pdf");

    $pdfFilePath = "uploads/Adoption_Contract_" . $animal[0]['name'] . ".pdf";

    for ($i=1; $i<=($pagecount); $i++) {
        $pdf->AddPage();
        $import_page = $pdf->ImportPage($i);
        $pdf->UseTemplate($import_page);
     

              ini_set('memory_limit','32M');      
              $pdf->WriteText(130,191, $animal[0]['name'] . " / " . $animal[0]['chart_num'] );
              $pdf->WriteText(130,199, $animal[0]['breed'] ); 
              $pdf->WriteText(130,206, $animal[0]['age'] ); 
              $pdf->WriteText(130,213, $animal[0]['sex'] ); 
              $pdf->WriteText(130,220, $animal[0]['microchip_num'] ); 
              //Name - 497, 747    
              //Breed -475, 775
              //Age - 466,805
              //Sex - 463, 834
              //Microchip - 505, 859

              $pdf->Output($pdfFilePath, 'F');
        
    }
   redirect($pdfFilePath);
 }

function getcompleteinfo($chart_num){
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

   $cat = false;
   $dog = false;
   //Explicit due to the ability to add new genders; this functionality is specifically requested for dogs/cats
   //and generates forms based on that species selection.
   $animal = $this->animal->getAnimalById($chart_num[0]);
    $vaccinations = $this->vaccination->getAllVaccination($chart_num[0]);
    $tests = $this->test->getAllTest($chart_num[0]);
    $weights = $this->weight->getAllWeights($chart_num[0]);

   if( strtoupper($animal[0]['species']) === "CAT"){
   $cat = true;
   }else if(  strtoupper($animal[0]['species']) === "DOG" ){
   $dog = true;
   }


     $this->load->library('pdf');

     $pdf =  $this->pdf->load();
    $pdf->allow_output_buffering = true;
    $pdf->debug = true;

  if($cat){
    $pagecount = $pdf->SetSourceFile("uploads/Adopter_Info_Cats_Template.pdf");
  }else if($dog){
    $pagecount = $pdf->SetSourceFile("uploads/Adopter_Info_Dogs_Template.pdf");
  }

    $pdfFilePath = "uploads/Adoption_Contract_Info_" . $animal[0]['name'] .".pdf";


    //If multiple pages; currently is not but in case the contract is updated
    for ($i=1; $i<=($pagecount); $i++) {
        $pdf->AddPage();
        $import_page = $pdf->ImportPage($i);
        $pdf->UseTemplate($import_page);

              ini_set('memory_limit','32M');

              $html = "<style>
                    table {
                        font-family: verdana, arial, sans-serif;
                        font-size: 11px;
                        color: #333333;
                        border-width: 1px;
                        border-color: #3A3A3A;
                        border-collapse: collapse;
                    }
                 
                    th {
                        border-width: 1px;
                        padding: 8px;
                        border-style: solid;
                        border-color: #517994;
                        background-color: #B2CFD8;
                    }
                 
                    td {
                        border-width: 1px;
                        padding: 8px;
                        border-style: solid;
                        border-color: #517994;
                        background-color: #ffffff;
                    }
              </style>";

              $html .= "<div align='center'><img style='display:block;margin:0 auto;text-align:center;' src='uploads/FatherJohnsHeader.png' width='414' height='120' /></div><br/>";

              if($cat){
              $html .= "<h2>Medical Information - Cats</h2>";
              }else if($dog){
              $html .= "<h2>Medical Information - Dogs</h2>";
              }

              $html .= "<table style='width:100%;'>
              <tr>
                <td>Date of Arrival:</td>
                <td>".$animal[0]['date_of_arrival']."</td>
              </tr>
              <tr>
                <td>ID Number:</td>
                <td>".$animal[0]['chart_num']."</td>
              </tr>
              <tr>
                <td>Name:</td>
                <td>".$animal[0]['name']."</td>
              </tr>
              <tr>
                <td>Breed:</td>
                <td>".$animal[0]['breed']."</td>
              </tr>
              <tr>
                <td>Last Recorded Weight:</td>";
              if(!empty($weights)){
                $html .= "<td>" . end($weights)['weight'] . "</td>";
              }else{
                $html .= "<td>N/A</td>";
              }
              $html .= "</tr>
              <tr>
                <td>Sex:</td>
                <td>".$animal[0]['sex']."</td>
              </tr>     
              <tr>
                <td>Microchip Number:</td>
                <td>".$animal[0]['microchip_num']."</td>
              </tr>                       
              </table>";

              $html .= "<h2>Preventative Care</h2>
              <table style='width:100%;'>
              <thead>
              <tr><td>Date Given/Tested</td><td>Details</td></tr>
              </thead><tbody>";
                
                foreach($tests as $test){
                  $html.= "<tr>";
                  $timestamp = strtotime($test['date_tested']);
                  $dmy = date("m/d/Y", $timestamp);
                  $html .= "<td>". $dmy . "</td>";
                  $html .= "<td>" . $test['name'];
                  if(isset($test['results']) &&  $test['results'] ){
                    $html .= " - PASS";
                  }else if( isset($test['results']) &&  !$test['results'] ){
                    $html .= " - FAIL";
                  }
                  $html .= "</td></tr>";
                }

                foreach($vaccinations as $vaccination){
                  $html.= "<tr>";
                  $timestamp = strtotime($vaccination['date_given']);
                  $dmy = date("m/d/Y", $timestamp);
                  $html .= "<td>" . $dmy . "</td>";
                  $html.= "<td>" . $vaccination['name'];
                  if(isset($vaccination['date_completed'])){
                    $html .= " Date Completed - " . $vaccination['date_completed'];
                  }
                  if(isset($vaccination['serial_num'])){
                    $html .= " Serial Number - " . $vaccination['serial_num'];
                  }
                  $html .= "</td></tr>";
                }

              $html .= "</tbody></table>";
              //$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
              $html = utf8_encode($html);
              $pdf->WriteHTML($html);

              $pdf->Output($pdfFilePath, 'F');

    }

   redirect($pdfFilePath);


}

function getmedicalinfo($chart_num){
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
    $animal = $this->animal->getAnimalById($chart_num[0]);
      $medications = $this->medication->getAllMedication($chart_num[0]);

    $this->load->library('pdf');

    $pdf =  $this->pdf->load();

    $pdf->allow_output_buffering = true;
    $pdf->debug = true;

    $pagecount = $pdf->SetSourceFile("uploads/MedicalTreatmentTemplate.pdf");

    $pdfFilePath = "uploads/Medical_Info_" . $animal[0]['name'] .".pdf";


    //If multiple pages; currently is not but in case the contract is updated
    for ($i=1; $i<=($pagecount); $i++) {
        $pdf->AddPage();
        $import_page = $pdf->ImportPage($i);
        $pdf->UseTemplate($import_page);


              ini_set('memory_limit','32M');

              $html = "<div align='center'><img style='display:block;margin:0 auto;text-align:center;' src='uploads/FatherJohnsHeader.png' width='414' height='120' /></div><br/>";

              $html .= "<style>
                    table {
                        font-family: verdana, arial, sans-serif;
                        font-size: 11px;
                        color: #333333;
                        border-width: 1px;
                        border-color: #3A3A3A;
                        border-collapse: collapse;
                    }
                 
                    th {
                        border-width: 1px;
                        padding: 8px;
                        border-style: solid;
                        border-color: #517994;
                        background-color: #B2CFD8;
                    }
                 
                    td {
                        border-width: 1px;
                        padding: 8px;
                        border-style: solid;
                        border-color: #517994;
                        background-color: #ffffff;
                    }
              </style>";

              $html .= "<h2>Medical Treatment History</h2>
              <table style='width:100%;'>
              <tr>
                <td>Name:</td>
                <td>".$animal[0]['name']."</td>
                <td>Color:</td>
                <td></td>
              </tr>
              <tr>
                <td>ID Number:</td>
                <td>".$animal[0]['chart_num']."</td>
                <td>Sex:</td>
                <td>".$animal[0]['sex']."</td>
              </tr>
              </table>";

              $html .= "<h2>Medications</h2>
              <table style='width:100%;'>
              <thead>
              <tr><td>Date Given</td><td>Medication Name & Notes</td></tr>
              </thead><tbody>";
              
                foreach($medications as $medication){
                  $timestamp = strtotime($medication['date_given']);
                  $dmy = date("m/d/Y", $timestamp);
                  $html .= "<tr><td>". $dmy . "</td>";
                  $html .= "<td>" . $medication['name'];
                  if(isset($medication['notes'])){
                    $html .= " - " . $medication['notes'];
                  }
                  $html .= "</td></tr>";
                }

              $html .= "</tbody></table>";
              
              $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
              //$html = utf8_encode($html);
              $pdf->WriteHTML($html);

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

    $pdf->allow_output_buffering = true;
    $pdf->debug = true;

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