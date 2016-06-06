<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
      $this->load->model('animal','',TRUE);
 }
 


 function index()
 {

    $this->load->library('form_validation');

    $data['animalnames'] = $this->animal->getAllAnimalNames();
    $data['animalcharts'] = $this->animal->getAllAnimalChartNums();
    $data['animalruns'] = $this->animal->getAllAnimalRunNames();
    $data['animalstatuses'] = $this->animal->getAllAnimalStatuses();


   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

   $this->form_validation->set_rules('search_type', 'Search Type', 'trim|required');
   $this->form_validation->set_rules('search_value', 'Search Value', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Search';
     $this->load->template('search_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
      if($this->search($this->input->post('search_type'),$this->input->post('search_value')) != null){
        //not the greatest implementation...
        $searchResults = $this->search($this->input->post('search_type'),$this->input->post('search_value'));

            $data['allanimals'] = $searchResults[0];
            $data['animalcolors'] = $searchResults[1];
            $data['run_names'] = $searchResults[2];

            $data['title'] = 'Search Results';
            $this->load->template('searchresults_view', $data);
      }else{
            $this->session->set_flashdata('results', 'No animal found!');
            //gets rid of the flash data persisting
            redirect('search', 'refresh');
     }
   }else{
     $data['title'] = 'Search';
     $this->load->template('search_view', $data);
   }

 }


 function search($search_type,$search_value){
    if($search_type == "id"){
     $result = $this->animal->getAnimalByID($search_value);
    }else if($search_type =="name"){
     $result = $this->animal->getAnimalByName($search_value);
    }else if($search_type == "run"){
     $result = $this->animal->getAnimalByRun($search_value);
    }else if($search_type == "status"){
     $result = $this->animal->getAnimalByStatus($search_value);
    }


    if($result){
      $allanimals = $result;
       $i = 0;
       foreach($result as $animal) {
         if($search_type == "run"){
         $colors[$i] = $this->animal->getAnimalRunColor($animal['animal_id']);
         }else{
         $colors[$i] = $this->animal->getAnimalRunColor($animal['id']);
         }
         $run_names[$i] = $this->animal->getRun($animal['run_num']);
        $i++;
       }

      return array($allanimals,$colors,$run_names);

    }else{
            $data['results'] = "There was a problem searching for your requested animal.";
      return false;
    }
 }
 
 
}
 
?>