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

     $data['title'] = 'Display An Animals';
     $this->load->template('displayanimal_view', $data);
    
   }
 

 }
 
?>