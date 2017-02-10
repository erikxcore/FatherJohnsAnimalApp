<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayAllCats extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   //$this->load->library("pagination");
 }
 


 function index()
 {


   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }
/*
       $config["base_url"] = base_url() . "displaycats";
    $config["total_rows"] = $this->animal->record_count_cats();
    $config["per_page"] = 10;
    $config["uri_segment"] = 2;
    if( !empty($config["total_rows"]) ){
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = round($choice);
    }else{
      $config["num_links"] = 1;
    }
    $this->pagination->initialize($config);
      if($this->uri->segment(2)){
      $page = ($this->uri->segment(2)) ;
      }
      else{
      $page = 0;
      }
*/

    $allanimals = $this->animal->getAllCats();

    if(!empty($allanimals)){  
    $i = 0;
    $allanimals = json_decode(json_encode($allanimals), true);
    foreach($allanimals as $animal) {
         $colors[$i] = $this->animal->getAnimalRunColor($animal['id']);
         $run_names[$i] = $this->animal->getRun($animal['run_num']);
         $i++;
    }
    $data['run_names'] = $run_names;
    $data['allanimals'] = $allanimals;
    $data['animalcolors'] = $colors;
    }else{
    $data['run_names'] = array();
    $data['allanimals'] = array();
    $data['animalcolors'] = array();
    }

     //$data["links"] = $this->pagination->create_links();


     $data['title'] = 'Display All Cats';
     $this->load->template('displayallcats_view', $data);

 }
 

 
}
 
?>