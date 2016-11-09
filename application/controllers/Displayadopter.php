<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayAdopter extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('adopter','',TRUE);
   $this->load->model('adopter_document','',TRUE);
   $this->load->library('encrypt');
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
 

 function index($id)
 {
    if($id == null){
      show_404();
    }

    $this->load->library('form_validation');

    $adopter = $this->adopter->getAdopterById($id);
    $adopter[0]['license'] = $this->encrypt->decode($adopter[0]['license']);
    $data['adopter'] = $adopter;
    $data['document_count'] = $this->adopter_document->record_count_documents($id);



   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display An Adopter';
     $this->load->template('displayadopter_view', $data);
    
   }








 

 }
 
?>