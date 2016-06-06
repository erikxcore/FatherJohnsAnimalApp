<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayDogs extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
 }
 


 function index()
 {
  
    $allanimals = $this->animal->getAllDogs();


       $i = 0;
       foreach($allanimals as $animal) {
         $colors[$i] = $this->animal->getAnimalRunColor($animal['id']);
         $run_names[$i] = $this->animal->getRun($animal['run_num']);
         $i++;
       }

    if(!empty($allanimals)){  
    $data['run_names'] = $run_names;
    $data['allanimals'] = $allanimals;
    $data['animalcolors'] = $colors;
    }else{
    $data['run_names'] = array();
    $data['allanimals'] = array();
    $data['animalcolors'] = array();
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

     $data['title'] = 'Display All Animals';
     $this->load->template('displayanimals_view', $data);

 }
 

 
}
 
?>