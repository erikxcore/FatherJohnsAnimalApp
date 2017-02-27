<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DogHome extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
      $this->load->model('animal','',TRUE);
      $this->load->model('homepage','',TRUE);
      $this->load->model('run','',TRUE);
      $this->load->model('history','',TRUE);
 }
 
 function index()
 {

     $recentanimals = $this->animal->getLastAddedDogAnimals();
 
     $data['recentanimals'] =   $recentanimals;

    $i = 0;
       foreach($recentanimals as $animal) {
         $colors[$i] = $this->animal->getAnimalRunColor($animal['id']);
         $run_names[$i] = $this->animal->getRun($animal['run_num']);
         $i++;
       }


     $data['run_names'] = $run_names;
     $data['animalcolors'] = $colors;

    $data['emergencyvaccinationdogs'] = $this->animal->getVaccinationRequiredDogs();

    $data['overduevaccinationsDogs'] = $this->animal->getOverdueVaccinationRequiredDogs();


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
     $this->load->template('doghome_view', $data);
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

 function change_run(){
    $date = date('Y-m-d H:i:s');
    $sd = $this->session->userdata('logged_in');
    $user= $sd['username'];

    $data = $this->input->post('data');
    $data = json_decode($data);
    //log_message('error', print_r($data,true));

    $chart_num = $data->chart_num;
    $run_num = $data->run_num;

    $result = $this->animal->change_animal_run($chart_num,$run_num,$user,$date);

    if($result){
      $this->history->addHistoryEntry($user,$date,"Modified an animal with chart number " . $chart_num . " & changed runs.");
      $this->session->set_flashdata('results', 'Run number changed!');
    }else{
      $this->session->set_flashdata('results', 'There was a problem changing the animal\'s run number.');
    }

    $this->reload_runs();
   //redirect('/doghome','refresh');

 }

 function reload_runs(){
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
      
      $theHTMLResponse    = $this->load->view('dogruns_view', $data,true);

      //log_message('error',$theHTMLResponse);

      $this->output->set_content_type('application/json');
      $this->output->set_output(json_encode(array('RunHtml'=> $theHTMLResponse)));


   }
   else
   {
     redirect('login', 'refresh');
   }
 }


 
}
 
?>