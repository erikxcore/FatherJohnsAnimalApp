<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CatHome extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
      $this->load->model('animal','',TRUE);
      $this->load->model('homepage','',TRUE);
      $this->load->model('run','',TRUE);
 }
 
 function index()
 {

     $recentanimals = $this->animal->getLastAddedCatAnimals();
 
     $data['recentanimals'] =   $recentanimals;

  



    $data['emergencyvaccinationcats'] = $this->animal->getVaccinationRequiredCats();

    $data['overduevaccinationsCats'] = $this->animal->getOverdueVaccinationRequiredCats();


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
     $this->load->template('cathome_view', $data);
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