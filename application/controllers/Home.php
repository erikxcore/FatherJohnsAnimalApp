<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
      $this->load->model('animal','',TRUE);
      $this->load->model('homepage','',TRUE);
      $this->load->model('run','',TRUE);
 }
 
 function index()
 {

     $recentanimals = $this->animal->getLastAddedAnimals();
 
     $data['recentanimals'] =   $recentanimals;

    $i = 0;
       foreach($recentanimals as $animal) {
         $colors[$i] = $this->animal->getAnimalRunColor($animal['id']);
         $run_names[$i] = $this->animal->getRun($animal['run_num']);
         $i++;
       }


     $data['run_names'] = $run_names;
     $data['animalcolors'] = $colors;


    $data['emergencyanimals'] = $this->animal->getMedicationRequiredAnimals();
    $data['emergencyvaccinationanimals'] = $this->animal->getVaccinationRequiredAnimals();

    $data['emergencyvaccinationdogs'] = $this->animal->getVaccinationRequiredDogs();
    $data['emergencyvaccinationcats'] = $this->animal->getVaccinationRequiredCats();

    if($this->homepage->getHomePageEnabled() == true){
      $allanimals = $this->animal->getAllAnimals();
      $data['allanimals'] = $allanimals;
      $data['colorandstatus'] = $this->run->getColorAndStatus();

      $data['custom_homepage_details'] = $this->homepage->getAllHomepageDetails();
      $data['custom_homepage_sections'] = $this->homepage->getSectionsAmount();
      $data['custom_homepage_json'] = $this->homepage->getSectionsJson();
      $data['runs'] = $this->run->getAllRunsByOrder();
      $data['other_runs'] = $this->run->getAllUnassignedRuns();
    }


   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];

     $data['title'] = 'Home';
     $this->load->template('home_view', $data);
   }
   else
   {
     redirect('login', 'refresh');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}
 
?>