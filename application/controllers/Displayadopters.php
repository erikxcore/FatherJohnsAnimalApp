<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayAdopters extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('adopter','',TRUE);
   $this->load->library('pagination');
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

    $config["base_url"] = base_url() . "displayadopters";
    $config["total_rows"] = $this->adopter->record_count_adopters();
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


     $alladopters = $this->adopter->get_all_adopter_paged($config["per_page"], $page);

      if(!empty($alladopters)){  
        $alladopters = json_decode(json_encode($alladopters), true);
        $data['alladopters'] = $alladopters;
      }else{
        $data['alladopters'] = array();
      }

     
     $data['links'] = $this->pagination->create_links();

     $data['title'] = 'Display All Adopters';
     $this->load->template('displayadopters_view', $data);

 }
 
  function removeadopter($id){
    if($id[0] == null){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify an adopter.');
        redirect('/displayadopters', 'refresh');
    }

    $this->adopter->removeAdopter($id[0]);

    $this->session->set_flashdata('results', 'Adopter successfully removed from the database.');
    
    redirect('/displayadopters', 'refresh');

 }

 
}
 
?>